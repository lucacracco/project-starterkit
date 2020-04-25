# Project StarterKit

> The project is a personal "starter kit pack" collector for projects in Drupal8 and others.


L'idea è quella di definire uno standard base per progetti dedicati a Drupal8 che prevedano l'uso di
* **docker**: per l'uso in ambiente locale e non;
* **robo.li**: per integrare un task manager dove porre comandi o funzioni ripetuti o consumati/usati spesso/periodicamente;

> L'idea finale è di estenderlo anche ad altri framework o strumenti che utilizzo nei progetti che seguo.

## Progetti

* [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project)
* [drupal/recommended-project](https://github.com/drupal/recommended-project)

### drupal-composer/drupal-project

Dal repository originale ho rimosso:

* la cartella `scripts`
* `.travis.yml`

Dal `composer.json` ho rimosso il richiamo verso la classe `/scripts/composer/ScriptHandler.php` per non richiamare alcune funzionalità di cui non necessito (verifica versione php e creazione file di default).

### drupal/recommended-project

Dal `composer.json` ho rimosso il `drupal-core-project-message`.

## Componenti

### Composer

Ai `composer.json` di entrambi i progetti ho aggiunto dei comandi che uso ripetutamente:

* `prestissimo`: mi permette di installare globalmente la famosa libreria;
* `nuke`: si occupa di cancellare la cache di composer, le cartelle `vendor` e le cartelle con il `core` e i moduli/temi/.. contrib per poi scaricare il tutto;

### Docker

Ho utilizzato [Docker4Drupal](https://github.com/wodby/docker4drupal).

Documentazione: [Local environment with Docker4Drupal](https://wodby.com/docs/stacks/drupal/local/).

I comandi di docker dovranno essere lanciati all'interno della cartella `docker`; non dalla root del progetto.

Ci sono alcuni comandi aggiuntivi come `analyze` e `exec`.

### Robo

La libreria che include i comandi di robo è [robo-drupal](https://github.com/lucacracco/robo-drupal).

Nella libreria sono presenti esempi su come interagire con i comandi per personalizzarli o eventualmente rimpiazzarli con dei propri custom definiti in un `Robofile` per il progetto.

Non è quindi necessario definire un `robofile` a meno che non si abbia bisogno di aggiungere comandi specifici al progetto su cui si sta lavorando.

## Come si inizia?

Si scaricare lo zip della progetto base interessato dall'ultima release disponibile e lo si scompatta dove si preferisce.

### Configurazioni di base

* Docker
* Drupal

#### Docker

- si personalizza il file `.env.dist` dentro la cartella `docker` clonando con nome `.env`;
- si lancia docker con i comandi presenti nel `Makefile`: 
`make up && make shell`
- per vedere gli altri comandi disponibili usare `make help` sempre dall'interno della cartella di docker;

#### Drupal8

- si personalizza il `composer.json` con le librerie, temi, moduli, ... che servono;
- si scaricano i pacchetti e le dipendenze col comando `composer install`;
- si personalizza `tpl.settings.php`/`tpl.services.yml` applicando le personalizzazioni necessarie come i dati di connessione al database, cartella di sincronizzazione ed altro;
- si utilizza i comandi di Robo per istanziare il portale Drupal:
  1. `robo drupal:scaffold`
     si occupa di generare i files settings/services ed altro;
  2. `robo drupal:install [profilo]`
     procede ad installare il portale col profilo (custom o meno) desiderato. 
     Non serve specificare i dati di connessione al database perchè già definiti nel `settings.php` che è stato generato col comando `scaffold` di prima.

## Approfondimenti

### settings.php

L'idea è quella di avere un template di default per il `settings.php` definito per sito e personalizzato; durante la procedura di `scaffold` viene preso il template di base `tpl.settings.php` e clonato in `settings.php`.

L'incentivo è quello di utilizzare le variabili d'ambiente; molti hosting (AWS, Platform, ecc..) forniscono dati di connessioni (es. database, redis, ecc..) come valori/variabili d'ambiente. L'idea è quella di uniformarsi ed abbandonare l'uso diretto di dati pre-configurati, anche per migliorare l'approccio ed installazione su hosting scalabili.

### services.yml

L'idea è la stessa del `settings.php` ma è molto meno difficile trovarsi in situazioni in cui è necessario iniettarci qualcosa dentro di variabile.

### Docker

Ho voluto inserire "il necessario per Docker" in una cartella apposita e non lasciare i files nella root del progetto. Ritengo che per una migliore organizzazione delle cartelle/files del progetto e per mantenere un distacco tra progetto e lamp stack, dividere così l'organizzazione.

Docker-compose può condividere i container e volumi tra diversi progetti che utilizzano questo template; in caso non si voglia personalizzare la variabile `COMPOSE_PROJECT_NAME` del file `.env` presente enlla cartella `docker`.

## Work in progress

Sto sviluppando la libreria [robo-drupal](https://github.com/lucacracco/robo-drupal) perchè possa comunque riuscire a leggere i dati presenti in files di configurazione .yml, caricandoli in modo gerarchico e solamente quelli interessati all'ambiente e al sito richiesto.
Al momento comunque non funziona.

Il passaggio successivo sarà quello di permettere di iniettare questi valori caricati dai files .yml all'interno di un template per `settings.php` e `services.yml` dedicati, usando forse l'engine template di Twig.

## Consigli

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

## Considerazioni 

* Robo è un task manager: ingloba più attività in un unica soluzione o meglio comando;
* Robo non deve fare ne produrre miracoli; non deve mai sostituirsi al lavoro di uno sviluppatore o di un builder o di qualsiasi persona che ha un compito e un attività manuale da fare;
* Robo non deve risolverti i problemi;
* Robo ti aiuta ad eseguire azioni ed attività ripetitive;
