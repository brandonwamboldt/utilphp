# UtilityPHP Unit Tests #

### Introduction

This is the testing documentation for util.php. The unit tests require PHPUnit,
and can be run in your web browser.

### Requirements

PHP Unit >= 3.5.6

    pear channel-discover pear.phpunit.de
    pear install phpunit/PHPUnit

vfsStream

    pear channel-discover pear.bovigo.org
    pear install bovigo/vfsStream-beta


#### Installation of PEAR and PHPUnit on Ubuntu

  Installation on Ubuntu requires a few steps. Depending on your setup you may
  need to use 'sudo' to install these. Mileage may vary but these steps are a
  good start.

    # Install the PEAR package
    sudo apt-get install php-pear

    # Add a few sources to PEAR
    pear channel-discover pear.phpunit.de
    pear channel-discover pear.symfony-project.com
    pear channel-discover components.ez.no
    pear channel-discover pear.bovigo.org

    # Finally install PHPUnit and vfsStream (including dependencies)
    pear install --alldeps phpunit/PHPUnit
    pear install --alldeps bovigo/vfsStream-beta

    # Finally, run 'phpunit' from within the ./tests directory
    # and you should be on your way!

## Test Suites:

Since util.php is a library meant to just be dropped into any project, it is
entirely self-contained and very easy to test. Just open tests/util.php in your
web browser and the tests will run (Must be run from a web server).
