<?php
session_start();
require_once '../util.php';

/**
 * PHPUnit test case for the util.php library
 *
 * @author  Brandon Wamboldt <brandon.wamboldt@gmail.com>
 * @since   1.0.000
 */
class UtilityPHPTest extends PHPUnit_Framework_TestCase
{
    public function test_get_var()
    {
        $_GET = array();
        $_GET['abc'] = 'def';
        $_GET['nested'] = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );

        // Looks for $_GET['abc']
        $this->assertEquals( 'def', util::get_var( 'abc' ) );

        // Looks for $_GET['nested']['key2']
        $this->assertEquals( 'val2', util::get_var( array( 'nested', 'key2' ) ) );

        // Looks for $_GET['doesnotexist']
        $this->assertEquals( 'defaultval', util::get_var( 'doesnotexist', 'defaultval' ) );
    }

    public function test_post_var()
    {
        $_POST = array();
        $_POST['abc'] = 'def';
        $_POST['nested'] = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );

        // Looks for $_POST['abc']
        $this->assertEquals( 'def', util::post_var( 'abc' ) );

        // Looks for $_POST['nested']['key2']
        $this->assertEquals( 'val2', util::post_var( array( 'nested', 'key2' ) ) );

        // Looks for $_POST['doesnotexist']
        $this->assertEquals( 'defaultval', util::post_var( 'doesnotexist', 'defaultval' ) );
    }

    public function test_request_var()
    {
        $_GET            = array();
        $_POST           = array();
        $_POST['abc']    = 'def';
        $_POST['nested'] = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );
        $_GET['xyz']     = 'mno';
        $_GET['nested']  = array( 'key1' => 'valA', 'key2' => 'valB' );

        // Looks for $_POST['abc'] or $_GET['abc']
        $this->assertEquals( 'def', util::request_var( 'abc' ) );

        // Looks for $_POST['xyz'] or $_GET['xyz']
        $this->assertEquals( 'mno', util::request_var( 'xyz' ) );

        // Looks for $_POST['doesnotexist'] or $_GET['doesnotexist']
        $this->assertEquals( 'defaultval', util::request_var( 'doesnotexist', 'defaultval' ) );

        // Conflict test
        if ( strstr( ini_get( 'request_order' ), 'GP' ) ) {
            $this->assertEquals( 'valB', util::request_var( array( 'nested', 'key2' ) ) );
        } else {
            $this->assertEquals( 'val2', util::request_var( array( 'nested', 'key2' ) ) );
        }
    }

    public function test_session_var()
    {
        // Unset all of the session variables.
        $_SESSION = array();

        $_SESSION['test_str'] = $test_str = md5( microtime() );
        $_SESSION['nested']   = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );

        // Looks for $_SESSION['test_str']
        $this->assertEquals( $test_str, util::session_var( 'test_str' ) );

        // Looks for $_SESSION['nested']['key2']
        $this->assertEquals( 'val2', util::session_var( array( 'nested', 'key2' ) ) );

        // Looks for $_SESSION['blah']
        $this->assertEquals( 'mydefaultvalue', util::session_var( 'blah', 'mydefaultvalue' ) );
    }

    public function test_cookie_var()
    {
        $_COOKIE = array();
        $_COOKIE['abc'] = 'def';
        $_COOKIE['nested'] = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );

        // Looks for $_COOKIE['abc']
        $this->assertEquals( 'def', util::cookie_var( 'abc' ) );

        // Looks for $_COOKIE['nested']['key2']
        $this->assertEquals( 'val2', util::cookie_var( array( 'nested', 'key2' ) ) );

        // Looks for $_COOKIE['doesnotexist']
        $this->assertEquals( 'defaultval', util::cookie_var( 'doesnotexist', 'defaultval' ) );
    }

    public function test_array_get()
    {
        $array = array();
        $array['abc'] = 'def';
        $array['nested'] = array( 'key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3' );

        // Looks for $array['abc']
        $this->assertEquals( 'def', util::array_get( $array, 'abc' ) );

        // Looks for $array['nested']['key2']
        $this->assertEquals( 'val2', util::array_get( $array, array( 'nested', 'key2' ) ) );

        // Looks for $array['doesnotexist']
        $this->assertEquals( 'defaultval', util::array_get( $array, 'doesnotexist', 'defaultval' ) );
    }

    public function test_slugify()
    {
        $this->assertEquals( 'a-simple-title', util::slugify( 'A simple title' ) );
        $this->assertEquals( 'this-post-it-has-a-dash', util::slugify( 'This post -- it has a dash' ) );
        $this->assertEquals( '123-1251251', util::slugify( '123----1251251' ) );
        $this->assertEquals( 'one23-1251251', util::slugify( '123----1251251', TRUE ) );
    }

    public function test_str_to_utf8()
    {
        // Make sure ASCII characters are ignored
        $this->assertEquals( "this\x01 is a \x7f test string", util::str_to_utf8( "this\x01 is a \x7f test string" ) );

        // Make sure UTF8 characters are ignored
        $this->assertEquals( "\xc3\x9c \xc3\xbc \xe6\x9d\xb1!", util::str_to_utf8( "\xc3\x9c \xc3\xbc \xe6\x9d\xb1!" ) );

        // Test long strings
        #util::str_to_utf8( str_repeat( 'x', 1024 * 1024 ) );
        $this->assertEquals( TRUE, TRUE );

        // Test some invalid UTF8 to see if it is properly fixed
        $input = "\xc3 this has \xe6\x9d some invalid utf8 \xe6";
        $expect = "\xEF\xBF\xBD this has \xEF\xBF\xBD\xEF\xBF\xBD some invalid utf8 \xEF\xBF\xBD";
        $this->assertEquals( $expect, util::str_to_utf8( $input ) );
    }

    public function test_seems_utf8()
    {
        // Test a valid UTF-8 sequence
        $this->assertTrue( util::seems_utf8( "\xEF\xBF\xBD this has \xEF\xBF\xBD\xEF\xBF\xBD some invalid utf8 \xEF\xBF\xBD" ) );

        // Test invalid UTF-8 sequences
        $this->assertFalse( util::seems_utf8( "\xc3 this has \xe6\x9d some invalid utf8 \xe6" ) );

        // And test some plain ASCII
        $this->assertTrue( util::seems_utf8( 'The quick brown fox jumps over the lazy dog' ) );
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
        $this->assertFalse( util::is_serialized( 'This is a string' ) );
        $this->assertFalse( util::is_serialized( 'a string' ) );
        $this->assertTrue( util::is_serialized( 'a:0:{}' ) );
        $this->assertTrue( util::is_serialized( 'O:8:"stdClass":2:{s:5:"prop1";s:5:"Hello";s:5:"prop2";s:5:"World";}' ) );
    }

    public function test_add_query_arg()
    {
        // Regular tests
        $this->assertEquals( '/app/admin/users?user=5', util::add_query_arg( 'user', 5, '/app/admin/users' ) );
        $this->assertEquals( '/app/admin/users?user=5', util::add_query_arg( array( 'user' => 5 ), '/app/admin/users' ) );
        $this->assertEquals( '/app/admin/users?action=edit&user=5', util::add_query_arg( 'user', 5, '/app/admin/users?action=edit' ) );
        $this->assertEquals( '/app/admin/users?action=edit&user=5', util::add_query_arg( array( 'user' => 5 ), '/app/admin/users?action=edit' ) );
        $this->assertEquals( '/app/admin/users?action=edit&tab=personal&user=5', util::add_query_arg( 'user', 5, '/app/admin/users?action=edit&tab=personal' ) );
        $this->assertEquals( '/app/admin/users?action=edit&tab=personal&user=5', util::add_query_arg( array( 'user' => 5 ), '/app/admin/users?action=edit&tab=personal' ) );

        // Url encoding test
        $this->assertEquals( '/app/admin/users?param=containsa%26sym', util::add_query_arg( 'param', 'containsa&sym', '/app/admin/users' ) );
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

        $this->assertFalse( util::str_to_bool( 'false' ) );
        $this->assertFalse( util::str_to_bool( 'no' ) );
        $this->assertFalse( util::str_to_bool( 'n' ) );
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

    public function test_absint()
    {
        $this->assertEquals( 5, util::absint( 5 ) );
        $this->assertEquals( 15, util::absint( 15 ) );
        $this->assertEquals( 5, util::absint( -5 ) );
        $this->assertEquals( 5, util::absint( 5.2 ) );
        $this->assertEquals( 5, util::absint( -5.15 ) );
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
    }

    public function test_zero_pad()
    {
        $this->assertEquals( '00000341', util::zero_pad( 341, 8 ) );
        $this->assertEquals( '341', util::zero_pad( 341, 1 ) );
    }

    public function test_human_time_diff()
    {
        $this->assertEquals( '1 minute ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MINUTE * 1.4 ) ) );
        $this->assertEquals( '5 minutes ago', util::human_time_diff( time() - ( util::SECONDS_IN_A_MINUTE * 5 ) ) );
        $this->assertEquals( '1 hour ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR ) ) );
        $this->assertEquals( '2 hours ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 2 ) ) );
        $this->assertEquals( '1 day ago', util::human_time_diff( time() - ( util::SECONDS_IN_AN_HOUR * 24 ) ) );
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
        $this->assertEquals( 'one', util::number_to_word( 1 ) );
        $this->assertEquals( 'five', util::number_to_word( 5 ) );
        $this->assertEquals( 'fifteen', util::number_to_word( 15 ) );
        $this->assertEquals( 'one hundred and thirty-six', util::number_to_word( 136 ) );
        $this->assertEquals( 'negative twelve', util::number_to_word( -12 ) );
        $this->assertEquals( 'zero point eight', util::number_to_word( 0.8 ) );
    }

    public function test_array_search_deep()
    {
        $users = array(
            1 => (object) array( 'username' => 'brandon', 'age' => 20 ),
            2 => (object) array( 'username' => 'matt', 'age' => 27 ),
            3 => (object) array( 'username' => 'jane', 'age' => 53 ),
            4 => (object) array( 'username' => 'john', 'age' => 41 ),
            5 => (object) array( 'username' => 'steve', 'age' => 11 ),
            6 => (object) array( 'username' => 'fred', 'age' => 42 ),
            7 => (object) array( 'username' => 'rasmus', 'age' => 21 ),
            8 => (object) array( 'username' => 'don', 'age' => 15 ),
            9 => (object) array( 'username' => 'darcy', 'age' => 33 ),
        );

        $this->assertEquals( 7, util::array_search_deep( $users, 'rasmus', 'username' ) );
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
        $this->assertTrue( preg_match( '/^([ABCDEFGHJKLMNPQRSTUVWXYZabcdefhjkmnprstuvwxyz23456789]{30})$/', $str ) );

        // Make sure the generated string is 120 characters long
        $str = util::random_string( 120 );
        $this->assertTrue( strlen( $str ) === 120 );
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

        $this->assertEquals( 'a', util::array_first( util::array_get( $test, 'a' ) ) );
    }

    public function test_array_first_key()
    {
        $test = array( 'a' => array( 'a' => 'b', 'c' => 'd' ) );

        $this->assertEquals( 'a', util::array_first_key( util::array_get( $test, 'a' ) ) );
    }

    public function test_array_last()
    {
        $test = array( 'a' => array( 'a', 'b', 'c' ) );

        $this->assertEquals( 'c', util::array_last( util::array_get( $test, 'a' ) ) );
    }

    public function test_array_last_key()
    {
        $test = array( 'a' => array( 'a' => 'b', 'c' => 'd' ) );

        $this->assertEquals( 'c', util::array_last_key( util::array_get( $test, 'a' ) ) );
    }

    public function test_array_flatten()
    {
        $input = array( 'a', 'b', 'c', 'd', array( 'e', 'f', 'g', array( 'h', 'i', array( array( array( array( 'j', 'k', 'l' ) ) ) ) ) ) );
        $expect = range( 'a', 'l' );

        $this->assertEquals( $expect, util::array_flatten( $input ) );
    }
}
