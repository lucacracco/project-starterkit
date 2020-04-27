TARGET ?= drupal8-recommended

## help	:	Print commands help.
.PHONY: help
help : Makefile
	@sed -n 's/^##//p' $<

## copy	:	Copy common files.
.PHONY: copy
copy:
# Set Permission.
	chmod 775 -R $(TARGET)
# Create directories.
	mkdir -p $(TARGET)/web/sites/default/
	mkdir -p $(TARGET)/config/default/sync
	mkdir -p $(TARGET)/web/modules/custom/module
# Copy directories.
	cp -TR drupal-common/docker $(TARGET)/docker
	cp -TR drupal-common/phpcs $(TARGET)/phpcs
	cp -TR drupal-common/examples/module $(TARGET)/web/modules/custom/module
# Copy files.
	cp -TR drupal-common/docker/.env.dist $(TARGET)/docker/.env
	cp -TR drupal-common/.gitignore $(TARGET)/.gitignore
	cp -TR drupal-common/README.md $(TARGET)/README.md
	cp -TR drupal-common/Robofile.php $(TARGET)/Robofile.php
	cp -TR drupal-common/.htaccess $(TARGET)/config/default/sync/.htaccess
	cp -TR drupal-common/examples/tpl.settings.php $(TARGET)/web/sites/default/tpl.settings.php
	cp -TR drupal-common/examples/tpl.services.yml $(TARGET)/web/sites/default/tpl.services.yml


## clear	:	Clear all files not necessary.
.PHONY: clear
clear:
# Set Permission.
	chmod 775 -R $(TARGET)
# Remove directories.
	rm -rf $(TARGET)/config
	rm -rf $(TARGET)/docker
	rm -rf $(TARGET)/phpcs
	rm -rf $(TARGET)/reports
	rm -rf $(TARGET)/web
	rm -rf $(TARGET)/vendor
# Remove files.
	rm -f $(TARGET)/Robofile.php
	rm -f $(TARGET)/composer.lock
	rm -f $(TARGET)/.editorconfig
	rm -f $(TARGET)/.gitattributes

## pre-commit	:	Clear and copy all files necessary.
.PHONY: pre-commit
pre-commit:
	make clear $(TARGET)
	make copy $(TARGET)

## test	:	Run tests.
.PHONY: test
test:
	make pre-commit $(TARGET)
	cd ./tests/$(TARGET) && TARGET=$(TARGET) ./start.sh
	cd ./tests/$(TARGET) && TARGET=$(TARGET) ./run.sh
	cd ./tests/$(TARGET) && TARGET=$(TARGET) ./stop.sh


# https://stackoverflow.com/a/6273809/1826109
%:
	@: