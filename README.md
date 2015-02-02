# Util.php [![Build Status](https://img.shields.io/travis/brandonwamboldt/utilphp.svg)](https://travis-ci.org/brandonwamboldt/utilphp) [![Coverage Status](https://img.shields.io/coveralls/brandonwamboldt/utilphp/master.svg)](https://coveralls.io/r/brandonwamboldt/utilphp)

[UtilPHP](http://brandonwamboldt.github.com/utilphp/) (Aka util.php) is a
collection of useful functions and snippets that you need or could use every
day. It's implemented as a class with static methods, to avoid conflicts with
your existing code-base. Just drop it in and start using it immediately.

Included are 55+ functions that provide you with the ability to do common
tasks much easier and more efficiently, without having to find that one comment
on php.net where you know it's been done already. Access superglobals without
checking to see if certain indexes are set first and pass default values, use a
nicely formatted var dump, validate emails, generate random strings, flatten an
array, pull a single column out of a multidimensional array and much more.

Although it's implemented as one giant class, util.php has extensive
documentation and a full suite of unit tests to avoid breaking
backwards-compatibility unintentionally.

## Release Information

This repo contains in development code for future releases as well as the
current stable branch. Development code is contained in the develop branch.

## Changelog and New Features

You can find a list of all changes for each release in the
[official documentation](http://brandonwamboldt.github.com/utilphp/#changelog)

## Installation

### Server Requirements

* PHP version 5.3.3 or higher.

### Standalone File

Simply drop `util.php` in any project and call `include 'util.php';` in your
project. You can then access the `Util` class.

### Composer

Add the following dependency to your composer.json:

```
"brandonwamboldt/utilphp": "1.0.*"
```

When used with composer, the class is namespaced (`\utilphp\util`) instead of
just `util`.

## Contributing

UtilPHP is a community driven project and accepts contributions of code and
documentation from the community. These contributions are made in the form of
Issues or [Pull Requests](http://help.github.com/send-pull-requests/) on the
[UtilityPHP repository](https://github.com/brandonwamboldt/utilphp) on GitHub.

Issues are a quick way to point out a bug. If you find a bug or documentation
error in UtilityPHP then please check a few things first:

* There is not already an open Issue
* The issue has already been fixed (check the develop branch, or look for closed Issues)
* Is it something really obvious that you fix it yourself?

Reporting issues is helpful but an even better approach is to send a Pull
Request, which is done by "Forking" the main repository and committing to your
own copy. This will require you to use the version control system called Git.

## Guidelines

Before we look into how, here are the guidelines. If your Pull Requests fail to
pass these guidelines it will be declined and you will need to re-submit when
you’ve made the changes. This might sound a bit tough, but it is required for
me to maintain quality of the code-base.

### PHP Style

Please ensure all new contributions match the [PSR-2](http://www.php-fig.org/psr/psr-2/)
coding style guide.

### Documentation

If you change anything that requires a change to documentation then you will
need to add it. New methods, parameters, changing default values, adding
constants, etc are all things that will require a change to documentation. The
change-log must also be updated for every change. Also PHPDoc blocks must be
maintained.

### PHP Version Compatibility

UtilityPHP is compatible with PHP 5.3.3 so all code supplied must stick to this
requirement.

Of particular note is avoiding short array notation like this:

```
$var = [];
```

Please use the old notation instead:

```
$var = array();
```

I know it's uglier, but PHP 5.3 while EOL'd, still isn't that old.

### Branching

One thing at a time: A pull request should only contain one change. That does
not mean only one commit, but one change - however many commits it took. The
reason for this is that if you change X and Y but send a pull request for both
at the same time, we might really want X but disagree with Y, meaning we cannot
merge the request. Using the Git-Flow branching model you can create new
branches for both of these features and send two requests.

## License

UtilPHP is licensed under the MIT license.

## Resources

* [Documentation](http://brandonwamboldt.github.com/utilphp/)
