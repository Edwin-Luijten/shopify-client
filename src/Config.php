<?php

namespace ShopifyClient;

class Config
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var array
     */
    private $resources;

    /**
     * Config constructor.
     * @param string $domain
     * @param string $key
     * @param string $secret
     * @param array $resources
     */
    public function __construct(string $domain, string $key, string $secret, array $resources = [])
    {
        $this->domain    = $domain;
        $this->key       = $key;
        $this->secret    = $secret;
        $this->resources = $resources;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return array
     */
    public function getResources(): array
    {
        return $this->resources;
    }
}
