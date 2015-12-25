#!/usr/bin/env bash

set -e

vendor/bin/phpunit --coverage-html ./build/coverage
vendor/bin/box build