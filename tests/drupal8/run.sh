#!/usr/bin/env bash

set -e

if [[ -n "${DEBUG}" ]]; then
  set -x
fi

cd ../../${TARGET}
cd docker

printf "\n\n Composer installation \n\n"
make exec "composer prestissimo"
make exec "composer install --prefer-dist"

printf "\n\nTest Robo commands\n\n"
make exec "robo list"
printf "\n\n"
make exec "robo scaffold"
printf "\n\n"
make exec "robo install standard"
printf "\n\n"
make exec "robo config:export"
printf "\n\n"
make exec "robo config:export"

printf "\n\nPhp Analyze\n\n"
make analyze