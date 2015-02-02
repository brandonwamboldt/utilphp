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

util.php includes a phpunit config file, so just run `phpunit` from the working
directory to run the test suite.

```
phpunit
```

If you want code coverage reports, use the following:

```
phpunit --coverage-html ./report
```
