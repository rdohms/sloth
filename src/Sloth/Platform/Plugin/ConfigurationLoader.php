<?php

namespace Sloth\Platform\Plugin;

use Webmozart\Glob\Glob;
use Zend\Stdlib\ArrayUtils;

class ConfigurationLoader
{
    /**
     * @var array
     */
    protected static $loadedFiles = [];

    /**
     * @param array  $config
     * @param string $rootAppPath
     *
     * @return array
     */
    public static function loadPluginConfigurations(array $config, string $rootAppPath = '/')
    {
        foreach (Glob::glob($rootAppPath . 'vendor/**/config/{{,*.}plugin,{,*.}local}.php') as $file) {
            self::storePluginConfigFile($file);
            $config = ArrayUtils::merge($config, include $file);
        }

        foreach (Glob::glob($rootAppPath . 'plugins/**/config/{{,*.}plugin,{,*.}local}.php') as $file) {
            self::storePluginConfigFile($file);
            $config = ArrayUtils::merge($config, include $file);
        }

        $config['loaded_plugins'] = self::$loadedFiles;

        return $config;
    }

    /**
     * Extracts relevant part of filename
     *
     * @param string $file
     */
    protected static function storePluginConfigFile(string $file)
    {
        preg_match('~((vendor|plugins).*)(/config/plugin.php)~', $file, $matches);
        $pluginName = $matches[1] ?? $file;

        self::$loadedFiles[] = $pluginName;
    }
}
