#!/usr/bin/env bash

set -e

if [[ -n "${DEBUG}" ]]; then
  set -x
fi

cd ../../${TARGET}
chmod 775 web/sites/default -R
cd docker
cp .env.dist .env

printf "\n\n"
make up

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

printf "\n\nRUN Behat tests\n\n"
make exec "robo behat --tags success"
printf "\n\nPhp Analyze\n\n"
make analyze

# Stop.
printf "\n\n"
make stop
make prune