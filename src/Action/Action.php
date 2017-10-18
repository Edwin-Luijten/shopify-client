<?php

namespace ShopifyClient\Action;

use ShopifyClient\Exception\ClientException;

class Action implements ActionInterface
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $validMethods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
    ];

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string|null
     */
    private $resourceKey;

    /**
     * @var string|null
     */
    private $responseKey;

    /**
     * Action constructor.
     * @param string $method
     * @param string $endpoint
     * @param string|null $responseKey
     * @param string|null $resourceKey
     */
    public function __construct(
        string $method,
        string $endpoint,
        string $responseKey = null,
        string $resourceKey = null
    ) {
        $this->setMethod($method);
        $this->setEndpoint($endpoint);
        $this->setResponseKey($responseKey);
        $this->setResourceKey($resourceKey);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return string|null
     */
    public function getResourceKey()
    {
        return $this->resourceKey;
    }

    /**
     * @return string|null
     */
    public function getResponseKey()
    {
        return $this->responseKey;
    }

    /**
     * @param string $method
     * @throws ClientException
     */
    private function setMethod(string $method)
    {
        if (!in_array($method, $this->validMethods)) {
            throw new ClientException(
                sprintf(
                    'Only the following methods are allowed: %s',
                    implode(
                        ',',
                        $this->validMethods
                    )
                )
            );
        }

        $this->method = $method;
    }

    /**
     * @param string $endpoint
     */
    private function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param string|null $resourceKey
     */
    private function setResourceKey(string $resourceKey = null)
    {
        $this->resourceKey = $resourceKey;
    }

    /**
     * @param string|null $responseKey
     */
    private function setResponseKey(string $responseKey = null)
    {
        $this->responseKey = $responseKey;
    }
}
