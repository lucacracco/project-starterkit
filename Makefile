## help	:	Print commands help.
.PHONY: help
help : Makefile
	@sed -n 's/^##//p' $<

## cpy	:	Copy common files
.PHONY: cpy
cpy:
	chmod 775 -R $(filter-out $@,$(MAKECMDGOALS))
	cp -TR drupal-common/docker $(filter-out $@,$(MAKECMDGOALS))/docker
	cp -TR drupal-common/phpcs $(filter-out $@,$(MAKECMDGOALS))/phpcs
	cp -TR drupal-common/examples/tpl.settings.php $(filter-out $@,$(MAKECMDGOALS))/web/sites/default/tpl.settings.php
	cp -TR drupal-common/examples/tpl.services.yml $(filter-out $@,$(MAKECMDGOALS))/web/sites/default/tpl.services.yml
	cp -TR drupal-common/examples/module $(filter-out $@,$(MAKECMDGOALS))/web/modules/custom/module


## clear	:	Clear all files not necessary.
.PHONY: clear
clear:
	chmod 775 -R $(filter-out $@,$(MAKECMDGOALS))
	rm -rf $(filter-out $@,$(MAKECMDGOALS))/docker
	rm -rf $(filter-out $@,$(MAKECMDGOALS))/phpcs
	rm -rf $(filter-out $@,$(MAKECMDGOALS))/web
	rm -rf $(filter-out $@,$(MAKECMDGOALS))/vendor
	rm -f $(filter-out $@,$(MAKECMDGOALS))/composer.lock
	rm -f $(filter-out $@,$(MAKECMDGOALS))/.editorconfig
	rm -f $(filter-out $@,$(MAKECMDGOALS))/.gitattributes
	rm -f $(filter-out $@,$(MAKECMDGOALS))/docker/.env


# https://stackoverflow.com/a/6273809/1826109
%:
	@: