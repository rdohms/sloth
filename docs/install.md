# Installing Sloth

## Get the code

`composer create-project sloth/sloth` 

## Configuring

Sloth uses two forms of configuration you can use to constumize it: `local.php` files and ENV variables. The reasoning behind this is that we want to allow you to easily deploy to sites like Heroku.
 
* via config file: copy and adjust `config/autoload/local.php.dist` to `config/autoload/local.php`
* via ENV vars: `export VAR='value'` or use a `.env` file in the root of the project.

### Available ENV vars

If you want to customize the base Sloth configs, you can set these variables.

* APP_DEBUG: true/false
* SLACK_URL: a url to the webhook you setup, example: ``
* CONFIG_CACHE: should configuration be cached (for production and reduction of file I/O)

## Deploying to self hosted

Sloth is just an HTTP app, create a host pointing to `public/` or use php's internal webserver with `php -S 0.0.0.0:8080 -t public/ public/index.php`

## Deploying to Heroku

TODO: we will be adding full instructions here

