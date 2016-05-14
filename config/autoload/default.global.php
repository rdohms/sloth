<?php

return [
    'debug' => getenv('APP_DEBUG') ?? true,

    'config_cache_enabled' => getenv('CONFIG_CACHE') ?? false,
];
