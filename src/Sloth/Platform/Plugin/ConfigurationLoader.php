<?php

namespace Sloth\Platform\Plugin;

use Lcobucci\DependencyInjection\ContainerBuilder;
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
    public static function loadPluginConfigurations(ContainerBuilder $containerBuilder, string $rootAppPath = '/')
    {
        foreach (Glob::glob($rootAppPath . '{vendor,plugins}/**/config/{{,*.}plugin}.xml') as $file) {
            self::storePluginConfigFile($file);
            $containerBuilder->addFile($file);
        }

        //TODO get loaded plugins out of here.
    }

    /**
     * Extracts relevant part of filename
     *
     * @param string $file
     */
    protected static function storePluginConfigFile(string $file)
    {
        preg_match('~((vendor|plugins).*)(/config/plugin.xml)~', $file, $matches);
        $pluginName = $matches[1] ?? $file;

        self::$loadedFiles[] = $pluginName;
    }
}
