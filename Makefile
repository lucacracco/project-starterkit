## help	:	Print commands help.
.PHONY: help
help : Makefile
	@sed -n 's/^##//p' $<

## clear	:	Clear all files not necessary.
.PHONY: clear
clear:
	rm $(filter-out $@,$(MAKECMDGOALS))/web
	rm $(filter-out $@,$(MAKECMDGOALS))/vendor
	rm $(filter-out $@,$(MAKECMDGOALS))/composer.lock


# https://stackoverflow.com/a/6273809/1826109
%:
	@: