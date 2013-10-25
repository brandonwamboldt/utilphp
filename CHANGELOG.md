Change Log
==========

1.0.6
-----

* Added `start_with` function
* Added `ends_with` function
* Added `str_contains` function
* Added `str_icontains` function
* Added `get_file_ext` function
* Fixing permissions on the files & directories
* Fixing a bug with the include path of util.php

1.0.5
-----

* [Issue #29](https://github.com/brandonwamboldt/utilphp/issues/29) Fixed error in `var_dump` if mbstring extension wasn't present
* Adding Composer support
* Updating license from GPL to MIT
* Adding Changelog to project
* Bumping minimum version to PHP 5.3.3

1.0.4
-----

* [Issue #22](https://github.com/brandonwamboldt/utilphp/issues/22) Removed all superglobal *_get functions, you can use the modified array_get now
* [Issue #22](https://github.com/brandonwamboldt/utilphp/issues/22) Modifed the behaviour of array_get, see documentation
* [Pull Request #21](https://github.com/brandonwamboldt/utilphp/pull/21) Added multibyte support to html* functions
* [Issue #9](https://github.com/brandonwamboldt/utilphp/issues/9) Removed the str_to_utf8 function
* [Issue #3](https://github.com/brandonwamboldt/utilphp/issues/3) Removed the absint function
* Removed declare() from util.php to avoid errors
* Updated PHPUnit tests to use PHPUnit 3.6

1.0.3
-----

* [Issue #16](https://github.com/brandonwamboldt/utilphp/issues/16) Improved performance of slugify
* [Issue #14](https://github.com/brandonwamboldt/utilphp/issues/14) Modified the regex for seems_utf8 to be more accurate
* [Issue #13](https://github.com/brandonwamboldt/utilphp/issues/13) Changed validate_email to be wrapper for filter_var
* Added 'ok' to the list of yes words for str_to_bool
* str_to_bool matches no followed by any number of 'o's

1.0.2
-----

* [Issue #12](https://github.com/brandonwamboldt/utilphp/issues/12) get_current_url() now includes the port and user/password if required
* [Issue #11](https://github.com/brandonwamboldt/utilphp/issues/11) human_time_diff() now uses the DateTime functions
* [Issue #10](https://github.com/brandonwamboldt/utilphp/issues/10) is_https() no longer checks the port as well

1.0.1
-----

* [Issue #7](https://github.com/brandonwamboldt/utilphp/issues/7) Added the $trust_proxy_headers parameter to get_client_ip()
* [Issue #6](https://github.com/brandonwamboldt/utilphp/issues/6) Removed is_isset() as the function did not work as intended
* [Issue #6](https://github.com/brandonwamboldt/utilphp/issues/6) Removed is_empty() as it is redundant, use ! with function calls instead
* Fixed a bug with get_gravatar()

1.0.0
-----

* Initial release of util.php.
