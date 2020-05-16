# Project StarterKit

> The project is a personal "starter kit pack" collector for projects in Drupal8/Symfony and others.


The idea is to define a basic standard for projects dedicated to Drupal8 and Symfony which that use of:
* [Docker](https://www.docker.com/)
* [Robo.li](https://robo.li/)

## Projects

* [Drupal8: drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project)
* [Drupal8: drupal/recommended-project](https://github.com/drupal/recommended-project)
* [Symfony](https://symfony.com/)

## Customizations Drupal8

#### drupal-composer/drupal-project

Add scripts:

* add `prestissimo` for install and use the composer plugin [hirak/prestissimo](https://github.com/hirak/prestissimo)
* add `nuke` for clear vendor dir and composer cache

Remove folders and files:

* `scripts`
* `.travis.yml`

#### drupal/recommended-project

Add/Delete scripts:

* add `prestissimo` for install and use the composer plugin [hirak/prestissimo](https://github.com/hirak/prestissimo)
* add `nuke` for clear vendor dir and composer cache
* delete `drupal-core-project-message`


#### Docker

I use [Docker4Drupal](https://github.com/wodby/docker4drupal).

Documentation: [Local environment with Docker4Drupal](https://wodby.com/docs/stacks/drupal/local/).

Docker commands must be launched inside the folder `docker`; not from the project root.

There are some additional commands like `analyze` e `exec`.

#### Robo

The library that includes robo commands is [robo-drupal](https://github.com/lucacracco/robo-drupal).

In the library there are examples of how to interact with the commands to personalize them or possibly replace them with your own custom defined in a `Robofile` for the project.

It is therefore not necessary to define a `robofile` unless you need to add specific commands to the project you are working on.

### How to use?

Download the zip of the base project by the latest available release.

#### Base configurations

* Docker
* Drupal

##### Docker

- clone the file `.env.dist` to `.env` and customize it;
- run docker with commands defined in the `Makefile`: 
`make up && make shell`
- see list makefile commands use `make help`;

##### Drupal

- customize the `composer.json` with libraries, themes, modules, ...;
- download packages and libraries with `composer install`;
- customize `tpl.settings.php`/`tpl.services.yml` (applying the necessary customizations such as database connection data, synchronization folder and more);
- use Robo's command for install a Drupal:
  1. `robo drupal:scaffold`
     generated the files settings/services and others;
  2. `robo drupal:install [profile]`
     installed the Drupal site with profile interested. 
     It is not necessary to specify the database connection data because it is already defined in the `settings.php` which was generated with the` scaffold` command before.

##### Insights

TODO: translate this section!

**settings.php**

L'idea è quella di avere un template di default per il `settings.php` definito per sito e personalizzato; durante la procedura di `scaffold` viene preso il template di base `tpl.settings.php` e clonato in `settings.php`.

L'incentivo è quello di utilizzare le variabili d'ambiente; molti hosting (AWS, Platform, ecc..) forniscono dati di connessioni (es. database, redis, ecc..) come valori/variabili d'ambiente. L'idea è quella di uniformarsi ed abbandonare l'uso diretto di dati pre-configurati, anche per migliorare l'approccio ed installazione su hosting scalabili.

**services.yml**

L'idea è la stessa del `settings.php` ma è molto meno difficile trovarsi in situazioni in cui è necessario iniettarci qualcosa dentro di variabile.

**Docker**

Ho voluto inserire "il necessario per Docker" in una cartella apposita e non lasciare i files nella root del progetto. Ritengo che per una migliore organizzazione delle cartelle/files del progetto e per mantenere un distacco tra progetto e lamp stack, dividere così l'organizzazione.

Docker-compose può condividere i container e volumi tra diversi progetti che utilizzano questo template; in caso non si voglia personalizzare la variabile `COMPOSE_PROJECT_NAME` del file `.env` presente enlla cartella `docker`.

**Work in progress**

Sto sviluppando la libreria [robo-drupal](https://github.com/lucacracco/robo-drupal) perchè possa comunque riuscire a leggere i dati presenti in files di configurazione .yml, caricandoli in modo gerarchico e solamente quelli interessati all'ambiente e al sito richiesto.
Al momento comunque non funziona.

Il passaggio successivo sarà quello di permettere di iniettare questi valori caricati dai files .yml all'interno di un template per `settings.php` e `services.yml` dedicati, usando forse l'engine template di Twig.

**Consigli**

* lancia sempre `composer prestissimo` per installarti in locale la libreria ed abbattere i tempi di download dei files del progetto;

* utilizza le variabili d'ambiente per il progetto dove puoi, specificandole nel `docker-compose.yml`come parametri ambientali - così facendo condividerai col team queste informazioni e saranno eventualmente sovrascrivili tramite l'uso del `docker-compose.override.yml`

* sono presenti dei `docker-compose.override.[OS].yml` specifici per sistema operativo: utilizza rinominandolo in `docker-compose.override.yml` quello specifico per il tuo caso;

* nel creare il template di riferimento per il `settings.php` è consigliato integrare/aggiornare le configurazioni seguendo uno schema comune:

  ```php
  $databases['default']['default'] = [
    'database' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT'),
    'driver' => 'mysql',
    'prefix' => '',
    'collation' => 'utf8mb4_general_ci',
  ];
  ...
  $settings['config_sync_directory'] = '/directory/outside/webroot';
  ...
  $settings['deployment_identifier'] = 'VERSION';
  ...
  if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
    include $app_root . '/' . $site_path . '/settings.local.php';
  }
  ```

## Customizations Symfony5

Add scripts:

* "prestissimo" for install and use the composer plugin [hirak/prestissimo](https://github.com/hirak/prestissimo)
* "nuke" for clear vendor dir and composer cache
