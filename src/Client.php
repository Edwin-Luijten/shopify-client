<?php

namespace ShopifyClient;

use ShopifyClient\Resource\AbandonedCheckouts;
use ShopifyClient\Resource\Blog;
use ShopifyClient\Resource\Country;
use ShopifyClient\Resource\Customer;
use ShopifyClient\Resource\FulfillmentService;
use ShopifyClient\Resource\Order;
use ShopifyClient\Resource\PriceRule;
use ShopifyClient\Resource\Product;
use ShopifyClient\Resource\Resource;
use ShopifyClient\Resource\ResourceCollection;
use ShopifyClient\Resource\Shop;
use ShopifyClient\Resource\User;
use ShopifyClient\Resource\Webhook;

/**
 * @property AbandonedCheckouts $abandonedCheckouts
 * @property Blog $blogs
 * @property Country $countries
 * @property Customer $customers
 * @property FulfillmentService $fulfillmentServices
 * @property PriceRule $priceRules
 * @property Product $products
 * @property Order $orders
 * @property Shop $shop
 * @property User $users
 * @property Webhook $webhooks
 */
class Client
{
    const API_URL = 'https://%s/admin/';

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var ResourceCollection
     */
    private $resources;

    /**
     * Client constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->initializeHttpClient();
    }

    private function initializeHttpClient()
    {
        $this->resources = new ResourceCollection(
            new Request(new \GuzzleHttp\Client([
                'base_uri' => $this->getBaseUrl(),
                'headers'  => [
                    'Content-Type'    => 'application/json',
                    'Accept-Encoding' => 'application/json',
                    'User-Agent'      => $this->getBaseUrl(),
                    'Authorization'   => 'Basic ' . $this->getCredentials(),
                ]
            ])),
            $this->config->getResources()
        );
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        if (!empty($this->config->getAccessToken())) {
            return $this->config->getDomain();
        }

        return sprintf(self::API_URL, $this->config->getDomain());
    }

    /**
     * @return string
     */
    private function getCredentials(): string
    {
        return base64_encode(sprintf(
            '%s:%s',
            $this->config->getKey(),
            $this->config->getSecret()
        ));
    }

    /**
     * @param $name
     * @return Resource
     */
    public function getResource(string $name): Resource
    {
        return $this->resources->getResource($name);
    }

    /**
     * @param $name
     * @return Resource
     */
    public function __get(string $name): Resource
    {
        return $this->resources->getResource($name);
    }
}
