TARGET ?= drupal8-recommended

## help	:	Print commands help.
.PHONY: help
help : Makefile
	@sed -n 's/^##//p' $<

## test	:	Run tests.
.PHONY: test
test:
	cd ./tests/$(TARGET) && TARGET=$(TARGET) ./tests.sh

# https://stackoverflow.com/a/6273809/1826109
%:
	@: