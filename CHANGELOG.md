Change Log
==========

1.1.0
-----

This release introduces a deprecation notice for `slugify()`, please update your code.

* Added a cryptographically secure random string function `secure_random_string`. Thanks to @abhimanyusharma003 via [Pull Request #53](https://github.com/brandonwamboldt/utilphp/pull/53)
* Added `limit_characters` and `limit_words` functions. Thanks to @abhimanyusharma003 via [Pull Request #55](https://github.com/brandonwamboldt/utilphp/pull/55)
* Added `rmdir` method to recursively delete a directory. Thanks to @ARACOOOL via [Pull Request #56](https://github.com/brandonwamboldt/utilphp/pull/56)
* Added `set_executable`, `set_readable`, `set_writable`, `directory_size`, `directory_contents` and `get_user_dir` functions. Thanks to @sergserg via [Pull Request #70](https://github.com/brandonwamboldt/utilphp/pull/70)
* Changed parameter ordering for `slugify`, `$css_mode` is now the third argument. For backwards compatibility, the old order will still work but it will generate an `E_USER_DEPRECATED` warning. Thanks to @abhimanyusharma003 via [Pull Request #71](https://github.com/brandonwamboldt/utilphp/pull/71)
* Added `match_string` method. Thanks to @abhimanyusharma003 via [Pull Request #72](https://github.com/brandonwamboldt/utilphp/pull/72)
* Renamed internal methods (protected ones) for PSR-2 compliance
* General performance improvements, code quality improvements, and increased unit test coverage (special thanks to @hopeseekr for getting us near 100% coverage)

1.0.7
-----

* Added `fix_broken_serialization` to fix broken serialized strings (Thanks to @hopeseekr via [Pull Request #48](https://github.com/brandonwamboldt/utilphp/pull/48))
* Fixed `get_current_url` appending port 80 or 443 when not needed (Thanks to @scottchiefbaker via [Pull Request #49](https://github.com/brandonwamboldt/utilphp/pull/49))
* `var_dump` can now handle recursive data structures without crashing
* `var_dump` code was minified and cleaned up
* `array_flatten` was optimized (thanks to @hopeseekr via [Pull Request #47](https://github.com/brandonwamboldt/utilphp/pull/47))
* `remove_accents` was completely rewritten and is now ~4x faster

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
* [Issue #22](https://github.com/brandonwamboldt/utilphp/issues/22) Modifed the behaviour of `array_get`, see documentation
* [Pull Request #21](https://github.com/brandonwamboldt/utilphp/pull/21) Added multibyte support to html* functions
* [Issue #9](https://github.com/brandonwamboldt/utilphp/issues/9) Removed the `str_to_utf8` function
* [Issue #3](https://github.com/brandonwamboldt/utilphp/issues/3) Removed the `absint` function
* Removed declare() from util.php to avoid errors
* Updated PHPUnit tests to use PHPUnit 3.6

1.0.3
-----

* [Issue #16](https://github.com/brandonwamboldt/utilphp/issues/16) Improved performance of `slugify`
* [Issue #14](https://github.com/brandonwamboldt/utilphp/issues/14) Modified the regex for `seems_utf8` to be more accurate
* [Issue #13](https://github.com/brandonwamboldt/utilphp/issues/13) Changed `validate_email` to be wrapper for `filter_var`
* Added 'ok' to the list of yes words for `str_to_bool`
* `str_to_bool` matches no followed by any number of 'o's

1.0.2
-----

* [Issue #12](https://github.com/brandonwamboldt/utilphp/issues/12) `get_current_url` now includes the port and user/password if required
* [Issue #11](https://github.com/brandonwamboldt/utilphp/issues/11) `human_time_diff` now uses the DateTime functions
* [Issue #10](https://github.com/brandonwamboldt/utilphp/issues/10) `is_https` no longer checks the port as well

1.0.1
-----

* [Issue #7](https://github.com/brandonwamboldt/utilphp/issues/7) Added the `$trust_proxy_headers` parameter to `get_client_ip`
* [Issue #6](https://github.com/brandonwamboldt/utilphp/issues/6) Removed `is_isset` as the function did not work as intended
* [Issue #6](https://github.com/brandonwamboldt/utilphp/issues/6) Removed `is_empty` as it is redundant, use ! with function calls instead
* Fixed a bug with `get_gravatar`

1.0.0
-----

* Initial release of util.php.
