#!/usr/bin/env bash

set -e

vendor/bin/phpunit --coverage-html ./build/coverage
phpdoc -d src -d tests -t build/doc
vendor/bin/box build
