<?php

date_default_timezone_set('UTC');

require_once dirname(__FILE__) . '/../util.php';

/**
 * PHPUnit test case for the util.php library
 *
 * @author  Brandon Wamboldt <brandon.wamboldt@gmail.com>
 * @since   1.0.000
 */
class UtilityPHPTest extends PHPUnit_Framework_TestCase
{
    /**
     * Allows for the testing of private and protected methods.
     *
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('util');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function test_array_get()
    {
        $_GET = array();
        $_GET['abc'] = 'def';
        $_GET['nested'] = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );

        // Looks for $array['abc']
        $this->assertEquals( 'def', util::array_get( $_GET['abc'] ) );

        // Looks for $array['nested']['key2']
        $this->assertEquals( 'val2', util::array_get( $_GET['nested']['key2'] ) );

        // Looks for $array['doesnotexist']
        $this->assertEquals( 'defaultval', util::array_get( $_GET['doesnotexist'], 'defaultval' ) );
    }

    public function test_slugify()
    {
        $this->assertEquals( 'a-simple-title', util::slugify( 'A simple title' ) );
        $this->assertEquals( 'this-post-it-has-a-dash', util::slugify( 'This post -- it has a dash' ) );
        $this->assertEquals( '123-1251251', util::slugify( '123----1251251' ) );
        $this->assertEquals( 'one23-1251251', util::slugify( '123----1251251', TRUE ) );
    }

    public function test_seems_utf8()
    {
        // Test a valid UTF-8 sequence: "ÜTF-8 Fµñ".
        $validUTF8 = "\xC3\x9CTF-8 F\xC2\xB5\xC3\xB1";
        $this->assertTrue( util::seems_utf8( $validUTF8 ) );

        $this->assertTrue( util::seems_utf8( "\xEF\xBF\xBD this has \xEF\xBF\xBD\xEF\xBF\xBD some invalid utf8 \xEF\xBF\xBD" ) );

        // Test invalid UTF-8 sequences
        $invalidUTF8 = "\xc3 this has \xe6\x9d some invalid utf8 \xe6";
        $this->assertFalse( util::seems_utf8( $invalidUTF8 ) );

        // And test some plain ASCII
        $this->assertTrue( util::seems_utf8( 'The quick brown fox jumps over the lazy dog' ) );

        // Test an invalid non-UTF-8 string.
        if (function_exists('mb_convert_encoding')) {
            mb_internal_encoding('UTF-8');
            // Converts the 'ç' UTF-8 character to UCS-2LE
            $utf8Char = pack('n', 50087);
            $ucsChar = mb_convert_encoding($utf8Char, 'UCS-2LE', 'UTF-8');

            // Ensure that PHP's internal encoding system isn't malconfigured.
            $this->assertEquals( $utf8Char, 'ç', 'This PHP system\'s internal character set is not properly set as UTF-8.' );
            $this->assertEquals( $utf8Char, pack('n', 50087), 'Something is wrong with your ICU unicode library.' );

            // Test for not UTF-8.
            $this->assertFalse( util::seems_utf8( $ucsChar) );

            // Test the worker method.
            $method = self::getMethod('seemsUtf8Regex');
            $this->assertFalse($method->invoke(null, $invalidUTF8), 'util::seemsUtf8Regex did not properly detect invalid UTF-8.');
            $this->assertTrue($method->invoke(null, $validUTF8), 'util::seemsUtf8Regex did not properly detect valid UTF-8.');
        }
    }

    public function test_size_format()
    {
        $size = util::size_format( 512, 0 );
        $this->assertEquals( '512 B', $size );

        $size = util::size_format( 2048, 1 );
        $this->assertEquals( '2.0 KiB', $size );

        $size = util::size_format( 25151251, 2 );
        $this->assertEquals( '23.99 MiB', $size );

        $size = util::size_format( 19971597926, 2 );
        $this->assertEquals( '18.60 GiB', $size );

        $size = util::size_format( 2748779069440, 1 );
        $this->assertEquals( '2.5 TiB', $size );

        $size = util::size_format( 2.81475e15, 1 );
        $this->assertEquals( '2.5 PiB', $size );

        $size = util::size_format( 2.81475e19, 1 );
        $this->assertEquals( '25000.0 PiB', $size );
    }

    public function test_maybe_serialize()
    {
        $obj = new stdClass();
        $obj->prop1 = 'Hello';
        $obj->prop2 = 'World';

        $this->assertEquals( 'This is a string', util::maybe_serialize( 'This is a string' ) );
        $this->assertEquals( 5.81, util::maybe_serialize( 5.81 ) );
        $this->assertEquals( 'a:0:{}', util::maybe_serialize( array() ) );
        $this->assertEquals( 'O:8:"stdClass":2:{s:5:"prop1";s:5:"Hello";s:5:"prop2";s:5:"World";}', util::maybe_serialize( $obj ) );
        $this->assertEquals( 'a:4:{i:0;s:4:"test";i:1;s:4:"blah";s:5:"hello";s:5:"world";s:5:"array";O:8:"stdClass":2:{s:5:"prop1";s:5:"Hello";s:5:"prop2";s:5:"World";}}', util::maybe_serialize( array( 'test', 'blah', 'hello' => 'world', 'array' => $obj ) ) );
    }

    public function test_maybe_unserialize()
    {
        $obj = new stdClass();
        $obj->prop1 = 'Hello';
        $obj->prop2 = 'World';

        $this->assertEquals( 'This is a string', util::maybe_unserialize( 'This is a string' ) );
        $this->assertEquals( 5.81, util::maybe_unserialize( 5.81 ) );
        $this->assertEquals( array(), util::maybe_unserialize( 'a:0:{}' ) );
        $this->assertEquals( $obj, util::maybe_unserialize( 'O:8:"stdClass":2:{s:5:"prop1";s:5:"Hello";s:5:"prop2";s:5:"World";}' ) );
        $this->assertEquals( array( 'test', 'blah', 'hello' => 'world', 'array' => $obj ), util::maybe_unserialize( 'a:4:{i:0;s:4:"test";i:1;s:4:"blah";s:5:"hello";s:5:"world";s:5:"array";O:8:"stdClass":2:{s:5:"prop1";s:5:"Hello";s:5:"prop2";s:5:"World";}}' ) );
    }

    public function test_is_serialized()
    {
        $this->assertFalse( util::is_serialized( 's:4:"test;' ) );
        $this->assertFalse( util::is_serialized( 'a:0:{}!' ) );
        $this->assertFalse( util::is_serialized( 'a:0' ) );
        $this->assertFalse( util::is_serialized( 'This is a string' ) );
        $this->assertFalse( util::is_serialized( 'a string' ) );
        $this->assertFalse( util::is_serialized( 'z:0;' ) );
        $this->assertTrue( util::is_serialized( 'N;' ) );
        $this->assertTrue( util::is_serialized( 'b:1;' ) );
        $this->assertTrue( util::is_serialized( 'a:0:{}' ) );
        $this->assertTrue( util::is_serialized( 'O:8:"stdClass":2:{s:5:"prop1";s:5:"Hello";s:5:"prop2";s:5:"World";}' ) );
    }

    public function test_fix_broken_serialization()
    {
        $expectedData = array(
            'Normal',
            'High-value Char: '.chr(231).'a-va?',   // High-value Char:  ça-va? [in ISO-8859-1]
        );

        $brokenSerialization = 'a:2:{i:0;s:6:"Normal";i:1;s:23:"High-value Char: ▒a-va?";}';

        // Temporarily override error handling to ensure that this is, in fact, [still] a broken serialization.
        {
            $expectedError = array(
                'errno' => 8,
                'errstr' => 'unserialize(): Error at offset 55 of 60 bytes'
            );

            $reportedError = array();
            set_error_handler(function ($errno, $errstr, $errfile, $errline, $errcontext) use (&$reportedError) {
                $reportedError = compact('errno', 'errstr');
            });

            unserialize($brokenSerialization);

            $this->assertEquals($expectedError['errno'], $reportedError['errno']);
            // Because HHVM's unserialize() error message does not contain enough info to properly test.
            if (!defined('HHVM_VERSION')) {
                $this->assertEquals($expectedError['errstr'], $reportedError['errstr']);
            }
            restore_error_handler();
        }

        $fixedSerialization = util::fix_broken_serialization($brokenSerialization);
        $unserializedData = unserialize($fixedSerialization);
        $this->assertEquals($expectedData[0], $unserializedData[0], 'Did not properly fix the broken serialized data.');

        $this->assertEquals(substr($expectedData[1], 0, 10), substr($unserializedData[1], 0, 10), 'Did not properly fix the broken serialized data.');
    }

    public function test_is_https()
    {
        $_SERVER['HTTPS'] = null;

        $this->assertFalse( util::is_https() );

        $_SERVER['HTTPS'] = 'on';

        $this->assertTrue( util::is_https() );
    }

    public function test_add_query_arg()
    {
        // Regular tests
        $this->assertEquals( '/app/admin/users?user=5', util::add_query_arg( 'user', 5, '/app/admin/users' ) );
        $this->assertEquals( '/app/admin/users?user=5', util::add_query_arg( array( 'user' => 5 ), '/app/admin/users' ) );
        $this->assertEquals( '/app/admin/users?user=5', util::add_query_arg( array( 'user' => 5 ), null, '/app/admin/users' ) );
        $this->assertEquals( '/app/admin/users?action=edit&user=5', util::add_query_arg( 'user', 5, '/app/admin/users?action=edit' ) );
        $this->assertEquals( '/app/admin/users?action=edit&user=5', util::add_query_arg( array( 'user' => 5 ), '/app/admin/users?action=edit' ) );
        $this->assertEquals( '/app/admin/users?action=edit&tab=personal&user=5', util::add_query_arg( 'user', 5, '/app/admin/users?action=edit&tab=personal' ) );
        $this->assertEquals( '/app/admin/users?action=edit&tab=personal&user=5', util::add_query_arg( array( 'user' => 5 ), '/app/admin/users?action=edit&tab=personal' ) );

        // With a URL fragment
        $this->assertEquals( '/app/admin/users?user=5#test', util::add_query_arg( 'user', 5, '/app/admin/users#test' ) );

        // Full URL
        $this->assertEquals( 'http://example.com?a=b', util::add_query_arg( 'a', 'b', 'http://example.com' ) );

        // Only the query string
        $this->assertEquals( '?a=b&c=d', util::add_query_arg( 'c', 'd', '?a=b' ) );
        $this->assertEquals( 'a=b&c=d', util::add_query_arg( 'c', 'd', 'a=b' ) );

        // Url encoding test
        $this->assertEquals( '/app/admin/users?param=containsa%26sym', util::add_query_arg( 'param', 'containsa&sym', '/app/admin/users' ) );

        // Superglobal test
        $_SERVER['REQUEST_URI'] = '/app/admin/users';
        $this->assertEquals( '/app/admin/users?user=6', util::add_query_arg( array( 'user' => 6 ) ) );
        $this->assertEquals( '/app/admin/users?user=7', util::add_query_arg( 'user', 7 ) );
    }

    public function test_remove_query_arg()
    {
        $this->assertEquals( '/app/admin/users', util::remove_query_arg( 'user', '/app/admin/users?user=5' ) );
        $this->assertEquals( '/app/admin/users?action=edit', util::remove_query_arg( 'user', '/app/admin/users?action=edit&user=5' ) );
        $this->assertEquals( '/app/admin/users?user=5', util::remove_query_arg( array( 'tab', 'action' ), '/app/admin/users?action=edit&tab=personal&user=5' ) );
    }

    public function test_str_to_bool()
    {
        $this->assertTrue( util::str_to_bool( 'true' ) );
        $this->assertTrue( util::str_to_bool( 'yes' ) );
        $this->assertTrue( util::str_to_bool( 'y' ) );
        $this->assertTrue( util::str_to_bool( 'oui' ) );
        $this->assertTrue( util::str_to_bool( 'vrai' ) );

        $this->assertFalse( util::str_to_bool( 'false' ) );
        $this->assertFalse( util::str_to_bool( 'no' ) );
        $this->assertFalse( util::str_to_bool( 'n' ) );
        $this->assertFalse( util::str_to_bool( 'non' ) );
        $this->assertFalse( util::str_to_bool( 'faux' ) );

        $this->assertFalse( util::str_to_bool( 'test' , false) );

    }

    public function test_array_pluck()
    {
        $array = array(
            array(
                'name' => 'Bob',
                'age'  => 37
            ),
            array(
                'name' => 'Fred',
                'age'  => 37
            ),
            array(
                'name' => 'Jane',
                'age'  => 29
            ),
            array(
                'name' => 'Brandon',
                'age'  => 20
            ),
            array(
                'age' => 41
            )
        );

        $obj_array = array(
            'bob' => (object) array(
                'name' => 'Bob',
                'age'  => 37
            ),
            'fred' => (object) array(
                'name' => 'Fred',
                'age'  => 37
            ),
            'jane' => (object) array(
                'name' => 'Jane',
                'age'  => 29
            ),
            'brandon' => (object) array(
                'name' => 'Brandon',
                'age'  => 20
            ),
            'invalid' => (object) array(
                'age' => 41
            )
        );

        $obj_array_expect = array(
            'bob'     => 'Bob',
            'fred'    => 'Fred',
            'jane'    => 'Jane',
            'brandon' => 'Brandon'
        );

        $this->assertEquals( array( 'Bob', 'Fred', 'Jane', 'Brandon' ), util::array_pluck( $array, 'name' ) );
        $this->assertEquals( array( 'Bob', 'Fred', 'Jane', 'Brandon', array( 'age' => 41 ) ), util::array_pluck( $array, 'name', TRUE, FALSE ) );
        $this->assertEquals( $obj_array_expect, util::array_pluck( $obj_array, 'name' ) );
        $this->assertEquals( array( 'Bob', 'Fred', 'Jane', 'Brandon' ), util::array_pluck( $obj_array, 'name', FALSE ) );
    }

    public function test_htmlentities()
    {
        $this->assertEquals( 'One &amp; Two', util::htmlentities( 'One & Two' ) );
        $this->assertEquals( 'One &amp; Two', util::htmlentities( 'One &amp; Two', TRUE ) );
    }

    public function test_htmlspecialchars()
    {
        $this->assertEquals( 'One &amp; Two', util::htmlspecialchars( 'One & Two' ) );
        $this->assertEquals( 'One &amp; Two', util::htmlspecialchars( 'One &amp; Two', TRUE ) );
    }

    public function test_remove_accents()
    {
        $this->assertEquals( 'A', util::remove_accents( "\xC3\x81" ) );
        $this->assertEquals( 'e', util::remove_accents( "\xC4\x97" ) );
        $this->assertEquals( 'U', util::remove_accents( "\xC3\x9C" ) );
        $this->assertEquals( 'Ae', util::remove_accents( "Ä", 'de' ) );
        $this->assertEquals( 'OEoeAEDHTHssaedhth', util::remove_accents(chr(140) . chr(156) . chr(198) . chr(208) . chr(222) . chr(223) . chr(230) . chr(240) . chr(254)));
    }

    public function test_zero_pad()
    {
        $this->assertEquals( '00000341', util::zero_pad( 341, 8 ) );
        $this->assertEquals( '341', util::zero_pad( 341, 1 ) );
    }

    public function test_human_time_diff()
    {
        $this->assertEquals( '1 second ago', util::human_time_diff( time() - 1 ) );
        $this->assertEquals( '30 seconds ago', util::human_time_diff( time() - 30 ) );
        $this->assertEquals( '1 minute ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MINUTE * 1.4 ) ) );
        $this->assertEquals( '5 minutes ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MINUTE * 5 ) ) );
        $this->assertEquals( '1 hour ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR ) ) );
        $this->assertEquals( '2 hours ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 2 ) ) );
        $this->assertEquals( '1 day ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 24 ) ) );
        $this->assertEquals( '5 days ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 24 * 5 ) ) );
        $this->assertEquals( '1 week ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 24 * 7 ) ) );
        $this->assertEquals( '2 weeks ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 24 * 14 ) ) );
        $this->assertEquals( '1 month ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_WEEK * 5 ) ) );
        $this->assertEquals( '2 months ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_WEEK * 10 ) ) );
        $this->assertEquals( '1 year ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MONTH * 15 ) ) );
        $this->assertEquals( '2 years ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MONTH * 36 ) ) );
        $this->assertEquals( '11 years ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MONTH * 140 ) ) );

        $this->assertEquals( 'fifteen minutes ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MINUTE * 15 ), '', TRUE ) );
    }

    public function test_number_to_word()
    {
        $this->assertEquals( 'positive one', util::number_to_word( '+1' ) );
        $this->assertEquals( 'one', util::number_to_word( 1 ) );
        $this->assertEquals( 'five', util::number_to_word( 5 ) );
        $this->assertEquals( 'fifteen', util::number_to_word( 15 ) );
        $this->assertEquals( 'twenty-one', util::number_to_word( 21 ) );
        $this->assertEquals( 'thirty-two', util::number_to_word( 32 ) );
        $this->assertEquals( 'forty-three', util::number_to_word( 43 ) );
        $this->assertEquals( 'fifty-four', util::number_to_word( 54 ) );
        $this->assertEquals( 'sixty-six', util::number_to_word( 66 ) );
        $this->assertEquals( 'seventy-seven', util::number_to_word( 77 ) );
        $this->assertEquals( 'eighty-eight', util::number_to_word( 88 ) );
        $this->assertEquals( 'ninety-nine', util::number_to_word( 99 ) );
        $this->assertEquals( 'one hundred and thirty-six', util::number_to_word( 136 ) );
        $this->assertEquals( 'negative twelve', util::number_to_word( -12 ) );
        $this->assertEquals( 'zero point eight', util::number_to_word( 0.8 ) );
        $this->assertEquals( 'ten', util::number_to_word( 10 ) );
        $this->assertEquals( 'twenty', util::number_to_word( 20 ) );
        $this->assertEquals( 'thirty', util::number_to_word( 30 ) );
        $this->assertEquals( 'forty', util::number_to_word( 40 ) );
        $this->assertEquals( 'fifty', util::number_to_word( 50 ) );
        $this->assertEquals( 'sixty', util::number_to_word( 60 ) );
        $this->assertEquals( 'seventy', util::number_to_word( 70 ) );
        $this->assertEquals( 'eighty', util::number_to_word( 80 ) );
        $this->assertEquals( 'ninety', util::number_to_word( 90 ) );
        $this->assertEquals( 'eleven', util::number_to_word( 11 ) );
        $this->assertEquals( 'thirteen', util::number_to_word( 13 ) );
        $this->assertEquals( 'fourteen', util::number_to_word( 14 ) );
        $this->assertEquals( 'fifteen', util::number_to_word( 15 ) );
        $this->assertEquals( 'sixteen', util::number_to_word( 16 ) );
        $this->assertEquals( 'seventeen', util::number_to_word( 17 ) );
        $this->assertEquals( 'eighteen', util::number_to_word( 18 ) );
        $this->assertEquals( 'nineteen', util::number_to_word( 19 ) );
        $this->assertEquals( 'one thousand', util::number_to_word( 1000 ) );
        $this->assertEquals( 'one million', util::number_to_word( 1000000 ) );
        $this->assertEquals( 'one billion', util::number_to_word( 1000000000 ) );
        $this->assertEquals( 'one trillion', util::number_to_word( 1000000000000 ) );
        $this->assertEquals( 'one quadrillion', util::number_to_word( '1000000000000000' ) );
        $this->assertEquals( 'one quintrillion', util::number_to_word( '1000000000000000000' ) );
        $this->assertEquals( 'one sextillion', util::number_to_word( '1000000000000000000000' ) );
        $this->assertEquals( 'one septillion', util::number_to_word( '1000000000000000000000000' ) );
        $this->assertEquals( 'one octillion', util::number_to_word( '1000000000000000000000000000' ) );
        $this->assertEquals( 'one nonillion', util::number_to_word( '1000000000000000000000000000000' ) );
        $this->assertEquals( 'one decillion', util::number_to_word( '1000000000000000000000000000000000' ) );
        $this->assertEquals( 'one', util::number_to_word( '1000000000000000000000000000000000000000000' ) );

    }

    public function test_array_search_deep()
    {
        $users = array(
            1  => (object) array( 'username' => 'brandon', 'age' => 20 ),
            2  => (object) array( 'username' => 'matt', 'age' => 27 ),
            3  => (object) array( 'username' => 'jane', 'age' => 53 ),
            4  => (object) array( 'username' => 'john', 'age' => 41 ),
            5  => (object) array( 'username' => 'steve', 'age' => 11 ),
            6  => (object) array( 'username' => 'fred', 'age' => 42 ),
            7  => (object) array( 'username' => 'rasmus', 'age' => 21 ),
            8  => (object) array( 'username' => 'don', 'age' => 15 ),
            9  => array( 'username' => 'darcy', 'age' => 33 ),
        );

        $test = array(
            1 => 'brandon',
            2 => 'devon',
            3 => array( 'troy' ),
            4 => 'annie'
        );

        $this->assertFalse( util::array_search_deep( $test, 'bob' ) );
        $this->assertEquals( 3, util::array_search_deep( $test, 'troy' ) );
        $this->assertEquals( 4, util::array_search_deep( $test, 'annie' ) );
        $this->assertEquals( 2, util::array_search_deep( $test, 'devon', 'devon' ) );
        $this->assertEquals( 7, util::array_search_deep( $users, 'rasmus', 'username' ) );
        $this->assertEquals( 9, util::array_search_deep( $users, 'darcy', 'username' ) );
        $this->assertEquals( 1, util::array_search_deep( $users, 'brandon' ) );
    }

    public function test_array_map_deep()
    {
        $input = array(
            '<',
            'abc',
            '>',
            'def',
            array( '&', 'test', '123' ),
            (object) array( 'hey', '<>' )
        );

        $expect = array(
            '&lt;',
            'abc',
            '&gt;',
            'def',
            array( '&amp;', 'test', '123' ),
            (object) array( 'hey', '<>' )
        );

        $this->assertEquals( $expect, util::array_map_deep( $input, 'htmlentities' ) );
    }

    public function test_random_string()
    {
        // Make sure the generated string contains only human friendly characters and is 30 characters long
        $str = util::random_string( 30 );
        $this->assertTrue( (bool) preg_match( '/^([ABCDEFGHJKLMNPQRSTUVWXYZabcdefhjkmnprstuvwxyz23456789]{30})$/', $str ) );

        // Make sure the generated string is 30 characters long
        $str = util::random_string( 30, false, true );
        $this->assertTrue( strlen( $str ) === 30, 'random_string produced an invalid length string' );

        // Make sure the generated string is 120 characters long
        $str = util::random_string( 120 );
        $this->assertTrue(strlen( $str ) === 120, 'random_string produced an invalid length string');

        // Make sure the string doesn't contain duplicate letters
        $str = util::random_string( 53, true, false, true );
        $this->assertTrue(strlen($str) === 53, 'random_string produced an invalid length string');
        $this->assertTrue(count(array_unique(str_split($str))) === strlen($str), 'random_string produced a string with duplicate characters');

        // Longer length than characters available
        try {
            $str = util::random_string( 55, true, false, true );
            $this->assertTrue( false );
        } catch (Exception $e) {
            $this->assertTrue( true );
        }

        // Test secure variant
        $str = util::secure_random_string(16);
        $this->assertTrue(strlen($str) === 16);

        // Longer length than characters available
        try {
            $str = util::secure_random_string(0);
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function test_validate_email()
    {
        $this->assertTrue( util::validate_email( 'john.smith@gmail.com' ) );
        $this->assertTrue( util::validate_email( 'john.smith+label@gmail.com' ) );
        $this->assertTrue( util::validate_email( 'john.smith@gmail.co.uk' ) );
    }

    public function test_safe_truncate()
    {
        $this->assertEquals( 'The quick brown fox...', util::safe_truncate( 'The quick brown fox jumps over the lazy dog', 24 ) );
        $this->assertEquals( 'The quick brown fox jumps over the lazy dog', util::safe_truncate( 'The quick brown fox jumps over the lazy dog', 55 ) );
        $this->assertEquals( 'Th...', util::safe_truncate( 'The quick brown fox jumps over the lazy dog', 2 ) );
        $this->assertEquals( 'The...', util::safe_truncate( 'The quick brown fox jumps over the lazy dog', 3 ) );
        $this->assertEquals( 'The...', util::safe_truncate( 'The quick brown fox jumps over the lazy dog', 7 ) );
    }

    public function test_limit_characters()
    {
        $this->assertEquals( 'The quick brown fox jump...', util::limit_characters( 'The quick brown fox jumps over the lazy dog', 24 ) );
        $this->assertEquals( 'The quick brown fox jumps over the lazy dog', util::limit_characters( 'The quick brown fox jumps over the lazy dog', 55 ) );
        $this->assertEquals( 'Th...', util::limit_characters( 'The quick brown fox jumps over the lazy dog', 2 ) );
        $this->assertEquals( 'The...', util::limit_characters( 'The quick brown fox jumps over the lazy dog', 3 ) );
        $this->assertEquals( 'The qui...', util::limit_characters( 'The quick brown fox jumps over the lazy dog', 7 ) );
        $this->assertEquals( 'The quick brown fox jumps over the lazy dog', util::limit_characters( 'The quick brown fox jumps over the lazy dog', 150 ) );
    }

    public function test_limit_words()
    {
        $this->assertEquals( 'The quick brown...', util::limit_words( 'The quick brown fox jumps over the lazy dog', 3 ) );
        $this->assertEquals( 'The quick brown fox jumps...', util::limit_words( 'The quick brown fox jumps over the lazy dog', 5 ) );
        $this->assertEquals( 'The...', util::limit_words( 'The quick brown fox jumps over the lazy dog', 1 ) );
        $this->assertEquals( 'The quick brown fox jumps over the lazy dog', util::limit_words( 'The quick brown fox jumps over the lazy dog', 90 ) );
        $this->assertEquals( 'The quick brown fox jumps over the...', util::limit_words( 'The quick brown fox jumps over the lazy dog', 7 ) );
    }

    public function test_ordinal()
    {
        $this->assertEquals( '1st', util::ordinal( 1 ) );
        $this->assertEquals( '2nd', util::ordinal( 2 ) );
        $this->assertEquals( '3rd', util::ordinal( 3 ) );
        $this->assertEquals( '4th', util::ordinal( 4 ) );
        $this->assertEquals( '5th', util::ordinal( 5 ) );
        $this->assertEquals( '6th', util::ordinal( 6 ) );
        $this->assertEquals( '7th', util::ordinal( 7 ) );
        $this->assertEquals( '8th', util::ordinal( 8 ) );
        $this->assertEquals( '9th', util::ordinal( 9 ) );
        $this->assertEquals( '22nd', util::ordinal( 22 ) );
        $this->assertEquals( '23rd', util::ordinal( 23 ) );
        $this->assertEquals( '143rd', util::ordinal( 143 ) );
    }

    public function test_array_first()
    {
        $test = array( 'a' => array( 'a', 'b', 'c' ) );

        $this->assertEquals( 'a', util::array_first( util::array_get( $test['a'] ) ) );
    }

    public function test_array_first_key()
    {
        $test = array( 'a' => array( 'a' => 'b', 'c' => 'd' ) );

        $this->assertEquals( 'a', util::array_first_key( util::array_get( $test['a'] ) ) );
    }

    public function test_array_last()
    {
        $test = array( 'a' => array( 'a', 'b', 'c' ) );

        $this->assertEquals( 'c', util::array_last( util::array_get( $test['a'] ) ) );
    }

    public function test_array_last_key()
    {
        $test = array( 'a' => array( 'a' => 'b', 'c' => 'd' ) );

        $this->assertEquals( 'c', util::array_last_key( util::array_get( $test['a'] ) ) );
    }

    public function test_array_flatten()
    {
        $input = array( 'a', 'b', 'c', 'd', array( 'first' => 'e', 'f', 'second' => 'g', array( 'h', 'third' => 'i', array( array( array( array( 'j', 'k', 'l' ) ) ) ) ) ) );
        $expectNoKeys = range( 'a', 'l' );
        $expectWithKeys = array(
            'a', 'b', 'c', 'd',
            'first' => 'e',
            'f',
            'second' => 'g',
            'h',
            'third' => 'i',
            'j', 'k', 'l'
        );

        $this->assertEquals( $expectWithKeys, util::array_flatten( $input ) );
        $this->assertEquals( $expectNoKeys, util::array_flatten( $input, false ) );
        $this->assertEquals( $expectWithKeys, util::array_flatten( $input, true ) );
    }

    public function test_strip_space()
    {
        $input = ' The quick brown fox jumps over the lazy dog ';
        $expect = 'Thequickbrownfoxjumpsoverthelazydog';

        $this->assertEquals($expect, Util::strip_space($input));
    }

    public function test_sanitize_string()
    {
        $input = ' Benoit! à New-York? j’ai perçu 1 % : Qu’as-tu "gagné" chez M. V. Noël? Dix francs.';
        $expect = 'benoitanewyorkjaipercu1quastugagnechezmvnoeldixfrancs';

        $this->assertEquals($expect, Util::sanitize_string($input));
    }

    public function test_get_gravatar()
    {
        $_SERVER['HTTPS'] = 'on';
        $this->assertEquals('https://secure.gravatar.com/avatar/a4bf5bbb9feaa2713d99a3b52ab80024?s=32', util::get_gravatar('john.doe@example.org'));
        $this->assertEquals('https://secure.gravatar.com/avatar/a4bf5bbb9feaa2713d99a3b52ab80024?s=128', util::get_gravatar('john.doe@example.org', 128));

        $_SERVER['HTTPS'] = 'off';
        $this->assertEquals('http://www.gravatar.com/avatar/a4bf5bbb9feaa2713d99a3b52ab80024?s=32', util::get_gravatar('john.doe@example.org'));
        $this->assertEquals('http://www.gravatar.com/avatar/a4bf5bbb9feaa2713d99a3b52ab80024?s=128', util::get_gravatar('john.doe@example.org', 128));
    }

    public function test_get_client_ip()
    {
        $_SERVER['REMOTE_ADDR'] = '192.168.30.152';
        $_SERVER['HTTP_CLIENT_IP'] = '192.168.30.153';
        $_SERVER['HTTP_X_FORWARDED_FOR'] = '192.168.30.154';
        $this->assertEquals('192.168.30.152', util::get_client_ip());
        $this->assertEquals('192.168.30.153', util::get_client_ip(true));

        unset($_SERVER['HTTP_CLIENT_IP']);
        $this->assertEquals('192.168.30.154', util::get_client_ip(true));
        unset($_SERVER['HTTP_X_FORWARDED_FOR']);
        $this->assertEquals('192.168.30.152', util::get_client_ip(true));
    }

    public function test_full_permissions()
    {
        $this->assertEquals('lr--r--r--', util::full_permissions('/tmp/file.txt', octdec('120444')));
        $this->assertEquals('ur--r--r--', util::full_permissions('/tmp/file.txt', octdec('000444')));
        $this->assertEquals('srwxr-xr-x', util::full_permissions('/tmp/file.txt', octdec('140755')));
        $this->assertEquals('drwxr-xr-x', util::full_permissions('/tmp/file.txt', octdec('40755')));
        $this->assertEquals('brw-rw----', util::full_permissions('/tmp/file.txt', octdec('60660')));
        $this->assertEquals('crw-rw----', util::full_permissions('/tmp/file.txt', octdec('20660')));
        $this->assertEquals('prw-rw----', util::full_permissions('/tmp/file.txt', octdec('10660')));
        $this->assertEquals('---x------', util::full_permissions('/tmp/file.txt', octdec('100100')));
        $this->assertEquals('--w-------', util::full_permissions('/tmp/file.txt', octdec('100200')));
        $this->assertEquals('--wx------', util::full_permissions('/tmp/file.txt', octdec('100300')));
        $this->assertEquals('-r--------', util::full_permissions('/tmp/file.txt', octdec('100400')));
        $this->assertEquals('-r-x------', util::full_permissions('/tmp/file.txt', octdec('100500')));
        $this->assertEquals('-rw-------', util::full_permissions('/tmp/file.txt', octdec('100600')));
        $this->assertEquals('-rwx------', util::full_permissions('/tmp/file.txt', octdec('100700')));
        $this->assertEquals('drwxr-xr-x', util::full_permissions('/'));
    }

    public function test_array_clean()
    {
        $input = array( 'a', 'b', '', null, false, 0);
        $expect = array('a', 'b');
        $this->assertEquals($expect, Util::array_clean($input));
    }

    public function test_var_dump_plain()
    {
        $input = 'var';
        $expect = '<span style="color:#588bff;">string</span><span style="color:#999;">(</span>3<span style="color:#999;">)</span> <strong>"var"</strong>';
        $this->assertEquals($expect, Util::var_dump_plain($input, true));

        $input = true;
        $expect = '<span style="color:#588bff;">bool</span><span style="color:#999;">(</span><strong>true</strong><span style="color:#999;">)</span>';
        $this->assertEquals($expect, Util::var_dump_plain($input, true));

        $input = 1;
        $expect = '<span style="color:#588bff;">int</span><span style="color:#999;">(</span><strong>1</strong><span style="color:#999;">)</span>';
        $this->assertEquals($expect, Util::var_dump_plain($input, true));

        $input = 1.5;
        $expect = '<span style="color:#588bff;">float</span><span style="color:#999;">(</span><strong>1.5</strong><span style="color:#999;">)</span>';
        $this->assertEquals($expect, Util::var_dump_plain($input, true));

        $input = null;
        $expect = '<strong>NULL</strong>';
        $this->assertEquals($expect, Util::var_dump_plain($input, true));

        $input = fopen('/tmp', 'r');
        $expect = '<span style="color:#588bff;">resource</span>("stream") <strong>"' . $input . '"</strong>';
        $this->assertEquals($expect, Util::var_dump_plain($input, -1));
        fclose($input);
    }

    public function test_var_dump()
    {
        $input = 'var';
        $expect = '<pre style="margin-bottom: 18px;background: #f7f7f9;border: 1px solid #e1e1e8;padding: 8px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border radius: 4px;display: block;font-size: 12.05px;white-space: pre-wrap;word-wrap: break-word;color: #333;font-family: Menlo,Monaco,Consolas,\'Courier New\',monospace;"><span style="color:#588bff;">string</span><span style="color:#999;">(</span>3<span style="color:#999;">)</span> <strong>"var"</strong></pre>';

        // Ensure the proper output is returned
        $this->assertEquals($expect, Util::var_dump($input, true));

        // Ensure the proper output is actually outputted
        $this->expectOutputString($expect);
        util::var_dump($input);

        // Ensure we avoid infinite recursion on recursive arrays
        $a = array('a' => 'value a', 'b' => 'value b');
        $b = array('test' => &$a);
        $c = array('a' => &$a, 'b' => &$b);
        $a['c'] = &$c;
        $b['c'] = &$c;
        $this->assertContains('*RECURSION DETECTED*', Util::var_dump($c, true));

        // Ensure we avoid infinite recursion on recursive objects
        $a = (object) array('a' => 'value a', 'b' => 'value b');
        $b = (object) array('test' => &$a);
        $c = (object) array('a' => &$a, 'b' => &$b);
        $a->c = &$c;
        $b->c = &$c;
        $this->assertContains('*RECURSION DETECTED*', Util::var_dump($c, true));
    }

    public function test_linkify()
    {
        $input = 'great websites: http://www.google.com?param=test and http://yahoo.com/a/nested/folder';
        $expect = 'great websites: <a href="http://www.google.com?param=test">http://www.google.com?param=test</a> and <a href="http://yahoo.com/a/nested/folder">http://yahoo.com/a/nested/folder</a>';
        $this->assertEquals($expect, Util::linkify($input));
    }

    public function test_start_with()
    {
        $this->assertTrue(Util::starts_with('start a string', 'start a'));
        $this->assertFalse(Util::starts_with('start a string', 'string'));
    }

    public function test_end_with()
    {
        $this->assertTrue(Util::ends_with('start a string', 'a string'));
        $this->assertFalse(Util::ends_with('start a string', 'start'));
    }

    public function test_contains()
    {
        $this->assertTrue(Util::str_contains('start a string', 'a string'));
        $this->assertFalse(Util::str_contains('start a string', 'Start'));
    }

    public function test_iContains()
    {
        $this->assertTrue(Util::str_icontains('start a string', 'a string'));
        $this->assertTrue(Util::str_icontains('start a string', 'Start'));
    }

    public function test_get_file_ext()
    {
        $input = 'a_pdf_fil.pdf';
        $expect = 'pdf';
        $this->assertEquals($expect, Util::get_file_ext($input));
    }

    public function test_rmdir()
    {
        $dirname = dirname(__FILE__);

        // Test deleting a non-existant directory
        $this->assertFalse(file_exists($dirname . '/test1'));
        $this->assertTrue(util::rmdir($dirname . '/test1'));

        // Test deleting an empty directory
        $dir = $dirname . '/test2';
        mkdir($dir);

        $this->assertTrue(is_dir($dir));

        if (is_dir($dir)) {
            util::rmdir($dir);
            $this->assertFalse(is_dir($dir));
        }

        // Test deleting a non-empty directory
        $dir = $dirname . '/test3';
        $file = $dirname . '/test3/test.txt';
        mkdir($dir);
        touch($file);

        $this->assertTrue(is_dir($dir));
        $this->assertTrue(is_file($file));

        if (is_dir($dir)) {
            util::rmdir($dir);
            $this->assertFalse(is_dir($dir));
            $this->assertFalse(is_file($file));
        }

        // Test deleting a non-directory path
        $file = $dirname . '/test4.txt';
        touch($file);

        try {
            $str = util::rmdir($file);
            $this->assertTrue(false);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }

        unlink($file);

        // Test deleting a nested directory
        $dir1 = $dirname . '/test5';
        $dir2 = $dirname . '/test5/nested_dir';
        $file1 = $dir1 . '/file1.txt';
        $file2 = $dir2 . '/file2.txt';
        mkdir($dir1);
        mkdir($dir2);
        touch($file1);
        touch($file2);

        $this->assertTrue(is_dir($dir1));
        $this->assertTrue(is_dir($dir2));
        $this->assertTrue(is_file($file1));
        $this->assertTrue(is_file($file2));

        if (is_dir($dir1)) {
            util::rmdir($dir1);
            $this->assertFalse(is_dir($dir1));
            $this->assertFalse(is_dir($dir2));
            $this->assertFalse(is_file($file1));
            $this->assertFalse(is_file($file2));
        }

        // Test symlink traversal.
        $dir = $dirname . '/test6';
        $nestedDir = "$dir/nested";
        $symlink = "$dir/nested-symlink";

        mkdir($dir);
        mkdir($nestedDir);

        $symlinkStatus = symlink($nestedDir, $symlink);
        $this->assertTrue($symlinkStatus, 'The test system does not support making symlinks.');

        if (!$symlink) {
            return;
        }

        $this->assertTrue(util::rmdir($symlink, true), 'Could not delete a symlinked directory.');
        $this->assertFalse(file_exists($symlink), 'Could not delete a symlinked directory.');
        util::rmdir($dir, true);
        $this->assertFalse(is_dir($dir), 'Could not delete a directory with a symlinked directory inside of it.');

    }
}
