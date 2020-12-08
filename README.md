![PROJECT](https://placeholder.com/200x100?text=Project+logo)

[PROJECT NAME](https://github.com/lucacracco/project-starterkit)

# Project name

> Ex. The project contains the company's website.

![LAMP](https://img.shields.io/badge/LAMP-Docker-blue)
![Software](https://img.shields.io/badge/Software-Drupal8-blue)

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

- Install Drupal and Project

    Scratch:

        robo scaffold
        robo install standard

    or from Database dump(.sql):

        robo scaffold
        robo install:database [path of .sql dump]

### Update

When you download a new code (pull from repository an updates), will run:

* Update composer vendor:

        composer prestissimo
        composer install --prefer-dist

* Update Drupal database:

        robo scaffold
        robo deploy

## Features

#### Export/import configuration

* (With docker) Access container PHP:

        cd docker
        make up
        make shell

* Export/Import:

        robo config:export
        robo config:import

## FAQ

- **How do I do *specifically* so and so?**
    - No problem! Just do this.
