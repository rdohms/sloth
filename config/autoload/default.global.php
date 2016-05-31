<?php

return [
    'debug' => (boolean) getenv('APP_DEBUG') ?? true,
    'config_cache_enabled' => (boolean) getenv('CONFIG_CACHE') ?? false,
];
