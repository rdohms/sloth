<?php

namespace Sloth\Platform\Middleware\Resolver;

use DomainException;
use Psr\Http\Message\StreamInterface;
use Psr7Middlewares\Transformers\BodyParser;

class ConfigurableBodyParser extends BodyParser
{
    protected $asArray;

    /**
     * ConfigurableBodyParser constructor.
     *
     * @param bool $asArray
     */
    public function __construct($asArray = false)
    {
        $this->asArray = $asArray;
        parent::__construct();
    }

    /**
     * @param StreamInterface $body
     *
     * @return array
     */
    public function json(StreamInterface $body)
    {
        $data = json_decode((string) $body, $this->asArray);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DomainException(json_last_error_msg());
        }

        return $data ?: [];
    }
}
