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

### Create new project

```shell
composer create-project lucacracco/project-starterkit:dev-drupal-9.x my-folder
```

Proceed to step [Setup (with docker)](#setup-with-docker).

### Clone

Clone this repo to your local machine using: `git clone git@...`

### DDEV

More
info: [https://ddev.readthedocs.io/en/stable/](https://ddev.readthedocs.io/en/stable/)
.

Run LAMP stack:

```shell
ddev start
ddev ssh
```

Note: You can override the `config.yaml` with extra files named `config.*.yaml`.

### Install

- Download libraries with `composer`:

  ```shell
  composer install --prefer-dist
  ```

- Install Drupal and Project

  Scratch:

  ```shell
  robo scaffold
  robo install standard
  ```

  or from Database dump(.sql):

  ```shell
  robo scaffold
  robo install:database [path of .sql dump]
  ```

### Update

When you download a new code (pull from repository an updates), will run:

* Update composer vendor:

  ```shell
  composer install --prefer-dist
  ```

* Update Drupal database:

  ```shell
  robo scaffold
  robo deploy
  ```

## Features

#### Export/import configuration

```shell
robo config:export
robo config:import
```

## FAQ

- **How do I do *specifically* so and so?**
    - No problem! Just do this.