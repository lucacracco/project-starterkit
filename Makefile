## help	:	Print commands help.
.PHONY: help
help : Makefile
	@sed -n 's/^##//p' $<

## clear	:	Clear all files not necessary.
.PHONY: clear
clear:
	chmod 775 -R $(filter-out $@,$(MAKECMDGOALS))
	rm -rf $(filter-out $@,$(MAKECMDGOALS))/web
	rm -rf $(filter-out $@,$(MAKECMDGOALS))/vendor
	rm -f $(filter-out $@,$(MAKECMDGOALS))/composer.lock
	rm -f $(filter-out $@,$(MAKECMDGOALS))/.editorconfig
	rm -f $(filter-out $@,$(MAKECMDGOALS))/.gitattributes
	rm -f $(filter-out $@,$(MAKECMDGOALS))/docker/.env


# https://stackoverflow.com/a/6273809/1826109
%:
	@: