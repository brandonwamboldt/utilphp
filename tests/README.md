# UtilityPHP Unit Tests #

### Introduction

This is the testing documentation for util.php. The unit tests require PHPUnit,
and can be run in your web browser.

### Requirements

PHP Unit >= 3.5.6

#### Installation of PHPUnit 

    # Download the PHPUnit phar.
    wget https://phar.phpunit.de/phpunit.phar

    # You can just run it locally. (Preferred for Windows)
    php phpunit.phar --version

    # Or install it system-wide.
    mv phpunit.phar phpunit
    chmod +x phpunit
    sudo mv phpunit /usr/local/bin
    phpunit --version

## Test Suites:

Since util.php is a library meant to just be dropped into any project, it is
entirely self-contained and very easy to test. Just open tests/util.php in your
web browser and the tests will run (Must be run from a web server).
