# Docker stack for porject

Based images of [Wodby](https://github.com/wodby).

**How can activate xdebug?**
Copy the content of `docker-compose.override.xdebug.yml` to `docker-compose.override.yml` and customized it.
Remove comments to activate the part of xDebug interested.

**How can disable traefik?**
Copy the content of `docker-compose.override.traefik.yml` to `docker-compose.override.yml`.

**I have the macOS**
You can activate the "mutagen" system. See https://wodby.com/docs/1.0/stacks/drupal/local/#docker-for-mac.
Follow the instructions for activate the external volume.

(from documentation page)
> `brew install mutagen-io/mutagen/mutagen`
> Uncomment Mutagen volume and service definitions in your compose file
> Replace codebase volumes definitions of services with the option below marked as "Mutagen"
> Start Mutagen: `make mutagen`
> Start other containers `make up`
> When you no longer need mutagen run mutagen project terminate
>
> Now when you change your code on the host machine Mutagen will sync your data to php and nginx/apache containers.
