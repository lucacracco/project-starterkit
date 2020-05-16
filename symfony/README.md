![PROJECT](https://placeholder.com/200x100?text=Project+logo)

[PROJECT NAME](https://github.com/lucacracco/project-starterkit)

# Project name

> Ex. The project contains the something.

![LAMP](https://img.shields.io/badge/LAMP-Docker-blue)
![Software](https://img.shields.io/badge/Software-Symfony-blue)

## Table of Contents

- [Installation](#installation)
- [Features](#features)
- [FAQ](#faq)

---

## Installation

### Clone

- Clone this repo to your local machine using: `git clone git@...`

### Setup (with docker)

- Clone the `docker/.env.dist` file to `docker/.env`

- Customize the `docker/.env` file with your parameters (see [Readme.md of docker](./docker/README.md))

- Run docker and access to container PHP:

        cd docker
        make up && make shell

### Install

- Download libraries with `composer`:

        composer prestissimo
        composer install --prefer-dist

## FAQ

- **How do I do *specifically* so and so?**
    - No problem! Just do this.
