#!/usr/bin/env bash

set -e

if [[ -n "${DEBUG}" ]]; then
  set -x
fi

cd ../../${TARGET}
cd docker

printf "\n\n"
make up