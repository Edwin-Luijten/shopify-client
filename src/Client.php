<?php

namespace ShopifyClient;

use ShopifyClient\Auth\OAuth;
use ShopifyClient\Resource\AbandonedCheckout;
use ShopifyClient\Resource\Blog;
use ShopifyClient\Resource\CarrierService;
use ShopifyClient\Resource\Country;
use ShopifyClient\Resource\Customer;
use ShopifyClient\Resource\FulfillmentService;
use ShopifyClient\Resource\Order;
use ShopifyClient\Resource\Page;
use ShopifyClient\Resource\PriceRule;
use ShopifyClient\Resource\Product;
use ShopifyClient\Resource\Resource;
use ShopifyClient\Resource\Shop;
use ShopifyClient\Resource\Webhook;

/**
 * @property AbandonedCheckout $abandonedCheckouts
 * @property Blog $blog
 * @property CarrierService $carrierServices
 * @property Country $countries
 * @property Order $orders
 * @property FulfillmentService $fulfillmentServices
 * @property Page $pages
 * @property PriceRule $priceRules
 * @property Product $products
 * @property Customer $customers
 * @property Shop $shop
 * @property Webhook $webhooks
 */
class Client
{
    const API_URL = 'https://%s:%s@%s';

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
        $config = [
            'base_uri' => $this->getBaseUrl()
        ];

        if (!empty($this->config->getAccessToken())) {
            $config['headers'] = [
                'X-Shopify-Access-Token' => $this->config->getAccessToken(),
            ];
        }

        $this->resources = new ResourceCollection(new \GuzzleHttp\Client($config), $this->config->getResources());
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        if (!empty($this->config->getAccessToken())) {
            return $this->config->getDomain();
        }

        return sprintf(
            self::API_URL,
            $this->config->getKey(),
            $this->config->getSecret(),
            $this->config->getDomain()
        );
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
