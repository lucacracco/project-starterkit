include .env

default: test

## help	:	Print commands help.
.PHONY: help
ifneq (,$(wildcard docker.mk))
help : docker.mk
	@sed -n 's/^##//p' $<
else
help : Makefile
	@sed -n 's/^##//p' $<
endif

## up	:	Create project for check.
.PHONY: test
test:
	@echo "Create project for check"
	mkdir -p tests
	docker run --rm --interactive --tty --volume `pwd`/tests:/var/www/html wodby/php:7.3-dev  /bin/bash -c 'composer global require hirak/prestissimo; composer create-project lucacracco/project-starterkit:dev-drupal-8.9.x'

## clear:	Clear project test.
.PHONY: clear
clear:
	@echo "Clear tests directory"
	rm -rf tests

# https://stackoverflow.com/a/6273809/1826109
%:
	@:
