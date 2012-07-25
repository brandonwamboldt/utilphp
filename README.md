# What is UtilityPHP? #

[UtilityPHP](http://brandonwamboldt.github.com/utilphp/) (Aka util.php) is a
collection of useful functions and snippets that you need or could use every
day. It's implemented as a class with static methods, to avoid conflicts with
your existing code-base. Just drop it in and start using it immediately.

Included are 40-odd functions that provide you with the ability to do common
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

## Server Requirements

* PHP version 5.2.4 or newer.

## Installation

Simple drop `util.php` in any project and call `include 'util.php';` in your
project. You can then access the `util` class.

## Contributing

UtilityPHP is a community driven project and accepts contributions of code and
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

All code must match the style of the existing code-base. An official style
guide will be added on a future date.

### Documentation

If you change anything that requires a change to documentation then you will
need to add it. New methods, parameters, changing default values, adding
constants, etc are all things that will require a change to documentation. The
change-log must also be updated for every change. Also PHPDoc blocks must be
maintained.

### Compatibility

UtilityPHP is compatible with PHP 5.2.4 so all code supplied must stick to this
requirement. If PHP 5.3 or 5.4 functions or features are used then there must
be a fallback for PHP 5.2.4.

### Branching

All pull requests must be sent to the "develop" branch. This is where the next
planned version will be developed. The "master" branch will always contain the
latest stable version and is kept clean so a "hotfix" (e.g: an emergency
security patch) can be applied to master to create a new version, without
worrying about other features holding it up. For this reason all commits need
to be made to "develop" and any sent to "master" will be closed.

One thing at a time: A pull request should only contain one change. That does
not mean only one commit, but one change - however many commits it took. The
reason for this is that if you change X and Y but send a pull request for both
at the same time, we might really want X but disagree with Y, meaning we cannot
merge the request. Using the Git-Flow branching model you can create new
branches for both of these features and send two requests.

### Signing

You must sign your work, certifying that you either wrote the work or otherwise
have the right to pass it on to an open source project. git makes this trivial
as you merely have to use --signoff on your commits to your UtilityPHP fork.

```
git commit --signoff
```

or simply:

```
git commit -s
```

This will sign your commits with the information setup in your git config, e.g.

> Signed-off-by: John Q Public <john.public@example.com>

If you are using Tower there is a "Sign-Off" checkbox in the commit window. You
could even alias git commit to use the -s flag so you don’t have to think about
it.

By signing your work in this manner, you certify to a "Developer's Certificate
or Origin". The current version of this certificate is in the
[DCO.txt](https://github.com/brandonwamboldt/utilphp/blob/master/DCO.txt) file in
the root of this repository.

## License

UtilityPHP is licensed under the
[GPL v3](https://github.com/brandonwamboldt/utilphp/blob/master/LICENSE.txt).
Please feel free to do whatever you'd like with the project. Include it in open
source or commercial projects. I'd prefer if you gave me credit of course :)

## Resources

* [Documentation](http://brandonwamboldt.github.com/utilphp/)
