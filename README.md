# Project StarterKit

> Il progetto si pone come un raccoglitore di "starter kit pack" per progetti in Drupal8.

L'idea è quella di definire uno standard base per progetti dedicati a Drupal8 che prevedano l'uso di
* **docker**: per l'uso in ambiente locale e non;
* **robo.li**: per integrare un task manager dove porre comandi o funzioni ripetuti o consumati/usati spesso/periodicamente;

In questo repository, tra il file README e il codice stesso, andrò a trascrivermi annotazioni, impressioni, decisioni e quant'altro che mi permetta di tenere una base comune per i miei progetti.

> L'idea finale è di estenderlo anche ad altri framework o strumenti che utilizzo nei progetti dei miei clienti.

## Drupal8

* drupal8-composer
* drupal8-recommended

### Folders

Non ho cambiato nulla dell'alberazione delle cartelle dai progetti originali; per drupal8-composer ho rimosso qualche cosa che non utilizzo come la cartella `scripts` nella quale era presente una classe che inizializzava i files per il sito di default che a volte è più una seccatura che altro.

**TODO**: non so se lasciare la cartella `drush` nella root per il progetto `drupal8-composer` perchè non mi è mai capitato fin'ora di usarla.

### Composer

Ai composer di entrambi i progetti ho aggiunto dei comandi che uso ripetutamente:

* `prestissimo`: mi permette di installare globalmente la famosa libreria;
* `nuke`: si occupa di cancellare la cache di composer, le cartelle `vendor` e le cartelle con il `core` e i moduli/temi/.. contrib per poi scaricare il tutto;

Per il progetto drupal8-composer ho rimosso il richiamo verso la classe `/scripts/composer/ScriptHandler.php` per non richiamare alcune funzionalità di cui non necessito (verifica versione php e creazione file di default).

### Docker

Non re-inventiamoci la ruota e usiamo: [Docker4Drupal](https://github.com/wodby/docker4drupal) che presenta anche una semplice documentazione tra le stesse pagine di Githubche quelle del servizio stesso: [Local environment with Docker4Drupal](https://wodby.com/docs/stacks/drupal/local/).

### Robo

### Come si inizia?

**Docker**

- si personalizza il file `.env.dist` dentro la cartella `docker` copiandolo in `.env`;
- si lancia docker con i comandi presenti nel `Makefile`: 
`make up && make shell`
- per vedere gli altri comandi disponibili usare `make help` sempre dall'interno della cartella di docker;

**Drupal8**

- si personalizza il `composer.json` con le librerie, temi, moduli, ... che servono;
- si utilizza i comandi di Robo per istanziare il portale Drupal:
`robo drupal:scaffold`: si occupa di generare i files settings/services ed altro;
`robo drupal:install [profilo]`: procede ad installare il portale col profilo (custom o meno) desiderato. Non serve specificare i dati di connessione al database perchè già definiti nel settings.php che abbiamo incluso col comando `scaffold` di prima.

NB: la libreria che include già i comandi di robo è [robo-drupal](https://github.com/lucacracco/robo-drupal).

#### Approfondimenti

###### settings.php

L'idea è quella di avere un template di default per il `settings.php` definito per sito e personalizzato; durante la procedura di `scaffold` prendere il template di base per clonarlo con le giuste modifiche su quello che poi sarà usato.

L'incentivo poi è quello di utilizzare le variabili d'ambiente; molti hosting (AWS, Platform, ecc..) forniscono dati di connesioni (es. database, redis, ecc..) come valori/variabili d'ambiente. L'idea è quella di uniformarsi ed abbandonare l'uso diretto di dati pre-configurati, anche per migliorare l'approccio ed installazione su hosting scalabili.

###### services.yml

L'idea è la stessa del `settings.php` ma è molto meno difficile trovarsi in situazioni in cui è necessario iniettarci qualcosa dentro di variabile.

### Drupal7

**TODO**

## Considerazioni 

###### Personali ed appunti (per ricordare che certe idee vanno scartate a priori)

#### Robo

* Robo è un task manager: ingloba più attività in un unica soluzione o meglio comando;
* Robo non deve fare ne produrre miracoli; non deve mai sostituirsi al lavoro di uno sviluppatore o di un builder o di qualcune persona che ha un compito e un attività manuale da fare;
* Robo non deve risolverti i problemi;
* Robo non deve aiutarti a trovare la voglia di lavorare;
* Robo ti aiuta a non dover ricordare settanta-cinque mila comandi da lanciare in seguenza per eseguire un operazione;
* Robo ti aiuta ad eseguire azioni ed attività ripetitive;
* Robo ti permette di andare in bagno e prenderti il caffè finchè lui si occupa di lanciare 15 comandi di drush che se lo avessi fatto te sicuramente ne avresti dimenticato qualcuno;

> Questo è Robo e come deve essere usato; se cerchi di usare Robo pensando che possa lavorare e concludere per te un progetto pronto ad essere consegnato al cliente, allora stai sbagliando in partenza. Idem se pensi che posso sostituirti nel tuo lavoro di sviluppatore.
>

