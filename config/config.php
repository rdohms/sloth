<?php

use Sloth\Platform\Error\ErrorHandlerLoader;
use Sloth\Platform\Plugin\ConfigurationLoader;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

/**
 * Configuration files are loaded in a specific order. First ``global.php``, then ``*.global.php``.
 * then ``local.php`` and finally ``*.local.php``. This way local settings overwrite global settings.
 *
 * The configuration can be cached. This can be done by setting ``config_cache_enabled`` to ``true``.
 *
 * Obviously, if you use closures in your config you can't cache it.
 */

$config = [];

// Load ENV vars
if (file_exists(__DIR__ . '/../.env')) {
    $config['env'] = new \Dotenv\Dotenv(__DIR__.'/../', '.env');
    $config['env']->load();
}

$cachedConfigFile = 'data/cache/app_config.php';

if (is_file($cachedConfigFile)) {
    // Try to load the cached config
    $config = include $cachedConfigFile;
} else {

    // Load Plugin Configuration (load first so that local configs can override it)
    $config = ConfigurationLoader::loadPluginConfigurations($config, __DIR__ . '/../');

    // Load configuration from autoload path
    foreach (Glob::glob('config/autoload/{{,*.}global,{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
        $config = ArrayUtils::merge($config, include $file);
    }

    // Cache config if enabled
    if (isset($config['config_cache_enabled']) && $config['config_cache_enabled'] === true) {
        file_put_contents($cachedConfigFile, '<?php return ' . var_export($config, true) . ';');
    }
}

// Overwrite ErrorHandling based on debug config (this app can benefit from easy debug enabling in production)
// due to its nature of running internally
$config = ErrorHandlerLoader::enableErrorHandling($config);

// Return an ArrayObject so we can inject the config as a service in Aura.Di
// and still use array checks like ``is_array``.
return new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
