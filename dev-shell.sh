#!/usr/bin/env bash

docker run -it --rm -v "${PWD}":"${PWD}" --net=host \
	    -w "${PWD}" originalbrownbear/php:7-cli-phpunit /bin/bash -l
