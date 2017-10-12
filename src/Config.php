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
     * @var string
     */
    private $accessToken;

    /**
     * Config constructor.
     * @param string $domain
     * @param string $key
     * @param string $secret
     * @param array $resources
     * @param string|null $accessToken
     */
    public function __construct(
        string $domain,
        string $key,
        string $secret,
        array $resources = [],
        string $accessToken = null
    ) {
        $this->domain      = $domain;
        $this->key         = $key;
        $this->secret      = $secret;
        $this->resources   = $resources;
        $this->accessToken = $accessToken;
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

    /**
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
