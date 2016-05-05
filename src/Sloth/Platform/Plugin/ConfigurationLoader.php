<?php

namespace Sloth\Platform\Plugin;

use Webmozart\Glob\Glob;
use Zend\Stdlib\ArrayUtils;

class ConfigurationLoader
{
    /**
     * @param        $config
     * @param string $rootAppPath
     *
     * @return array
     */
    public static function loadPluginConfigurations($config, $rootAppPath = '/')
    {
        foreach (Glob::glob($rootAppPath . 'vendor/**/config/{{,*.}plugin,{,*.}local}.php') as $file) {
            $config = ArrayUtils::merge($config, include $file);
        }

        foreach (Glob::glob($rootAppPath . 'plugins/**/config/{{,*.}plugin,{,*.}local}.php') as $file) {
            $config = ArrayUtils::merge($config, include $file);
        }

        return $config;
    }
}
