eZ Tika is an extension that enables a handler for converting multiple binary file formats to plain text as used
by the search engine (if you enabled those attributes as searchable).

Currently, most common office formats are enabled (see also binaryfile.ini.append.php):

    [application/pdf]
    [application/msword]
    [application/vnd.ms-excel]
    [application/vnd.ms-powerpoint]
    [application/vnd.visio]
    [application/vnd.ms-outlook]
    [application/xml]
    [application/rtf]
    [application/vnd.oasis.opendocument.text]
    [application/vnd.oasis.opendocument.presentation]
    [application/vnd.oasis.opendocument.spreadsheet]
    [application/vnd.oasis.opendocument.formula]
    [application/zip]
    [application/vnd.openxmlformats-officedocument.wordprocessingml.document]
    [application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]
    [application/vnd.openxmlformats-officedocument.presentationml.presentation]
    [application/octet-stream]

## Installation:

See [INSTALL.md](INSTALL.md)

## License:

License for all but the tika.jar file: GNU GPL 2.0.
tika.jar is licensed with the ASF License (Apache)

## Running tests:

The bundle uses PHPUnit to run functional tests.

*NB* the tests do *not* mock interaction with the database, but create/modify/delete many types of data in it.
As such, there are good chances that running tests will leave stale/broken data.
It is recommended to run the tests suite using a dedicated eZPublish installation or at least a dedicated database.

#### Setting up a dedicated test environment for the bundle

A safe choice to run the tests of the extension is to set up a dedicated environment, similar to the one used when the
test suite is run on GitHub Actions.
The advantages are multiple: on one hand you can start with any version of eZPublish you want; on the other you will
be more confident that any tests you add or modify will also pass on GitHub.
The disadvantages are that you will need Docker and Docker-compose, and that the environment you will use will look
quite unlike a standard eZPublish setup! Also, it will take a considerable amount of disk space and time to build.

Steps to set up a dedicated test environment and run the tests in it:

    git clone --depth 1 https://github.com/tanoconsulting/euts.git teststack
    # if you have a github auth token, it is a good idea to copy it now to teststack/docker/data/.composer/auth.json

    # this config sets up a test environment with eZPlatform 2.5 running on php 7.4 / ubuntu jammy
    export TESTSTACK_CONFIG_FILE=Tests/environment/.euts.2.5.env

    ./teststack/teststack build
    ./teststack/teststack runtests
    ./teststack/teststack stop

Note: this will take some time the 1st time your run it, but it will be quicker on subsequent runs.
Note: make sure to have enough disk space available.

In case you want to run manually commands, such as the symfony console:

    ./teststack/teststack console cache:clear

Or easily get to a database shell prompt:

    ./teststack/teststack dbconsole

Or command-line shell prompt to the Docker container where tests are run:

    ./teststack/teststack shell

The tests in the Docker container run using the version of debian/php/mysql/eZPlatform kernel specified in the file
`Tests/environment/.euts.2.5.env`, as specified in env var `TESTSTACK_CONFIG_FILE`.
If no value is set for that environment variable, a file named `.euts.env` is looked for.
If no such file is present, some defaults are used, you can check the documentation in ./teststack/README.md to find out
what they are.
If you want to test against a different version of eZ/php/debian, feel free to:
- create the `.euts.env` file, if it does not exist
- add to it any required var (see file `teststack/.euts.env.example` as guidance)
- rebuild the test stack
- run tests the usual way

You can even keep multiple test stacks available in parallel, by using different env files, eg:
- create a file `.euts.env.local` and add to it any required env var, starting with a unique `COMPOSE_PROJECT_NAME`
- build the new test stack via `./teststack/teststack. -e .euts.env.local build`
- run the tests via: `./teststack/teststack -e .euts.env.local runtests`


[![License](https://poser.pugx.org/xrowgmbh/eztika/license)](https://packagist.org/packages/xrowgmbh/eztika)
[![Latest Stable Version](https://poser.pugx.org/xrowgmbh/eztika/v/stable)](https://packagist.org/packages/xrowgmbh/eztika)
[![Total Downloads](https://poser.pugx.org/xrowgmbh/eztika/downloads)](https://packagist.org/packages/xrowgmbh/eztika)

[![Build Status](https://github.com/xrowgmbh/eztika/actions/workflows/ci.yml/badge.svg)](https://github.com/xrowgmbh/eztika/actions/workflows/ci.yml)
[![Code Coverage](https://codecov.io/gh/xrowgmbh/eztika/branch/main/graph/badge.svg)](https://codecov.io/gh/xrowgmbh/eztika/tree/master)
