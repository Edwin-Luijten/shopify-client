<?php

namespace ShopifyClient;

use ShopifyClient\Resource\Customer;
use ShopifyClient\Resource\Order;
use ShopifyClient\Resource\OrderRisk;
use ShopifyClient\Resource\Product;
use ShopifyClient\Resource\ProductImage;
use ShopifyClient\Resource\ProductVariant;

class Client
{
    const API_URL = 'https://%s:%s@%s';

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
     * @var Resource[]
     */
    private $resources = [
        'customers' => [
            'class' => Customer::class,
        ],
        'orders'    => [
            'class'     => Order::class,
            'resources' => [
                'risks' => [
                    'class' => OrderRisk::class,
                ],
            ],
        ],
        'products'  => [
            'class'     => Product::class,
            'resources' => [
                'variants' => [
                    'class' => ProductVariant::class,
                ],
                'images'   => [
                    'class' => ProductImage::class,
                ],
            ],
        ],
    ];

    /**
     * @var Customer
     */
    public $customers;

    /**
     * @var Order
     */
    public $orders;

    /**
     * @var Product
     */
    public $products;

    /**
     * Client constructor.
     * @param string $domain
     * @param string $key
     * @param string $secret
     */
    public function __construct(string $domain, string $key, string $secret)
    {
        $this->domain = $domain;
        $this->key    = $key;
        $this->secret = $secret;

        $this->initializeHttpClient();
    }

    private function initializeHttpClient()
    {
        $httpClient = new \GuzzleHttp\Client([
            'base_uri' => sprintf(self::API_URL, $this->key, $this->secret, $this->domain),
        ]);

        $this->loadResources($httpClient);
    }

    private function loadResources($httpClient)
    {
        foreach ($this->resources as $key => $resource) {
            if (property_exists($this, $key)) {
                $this->loadResource($key, $resource, $httpClient);
            }
        }
    }

    private function loadResource($key, $resource, $httpClient)
    {
        $this->{$key} = new $resource['class']($httpClient);

        if (isset($resource['resources'])) {
            $this->loadSubResources($key, $resource, $httpClient);
        }
    }

    private function loadSubResources($key, $resource, $httpClient)
    {
        foreach ($resource['resources'] as $subKey => $subResource) {
            $this->loadSubResource($key, $subKey, $subResource, $httpClient);
        }
    }

    private function loadSubResource($parent, $key, $resource, $httpClient)
    {
        if (property_exists($this->{$parent}, $key)) {
            $this->{$parent}->{$key} = new $resource['class']($httpClient);
        }
    }
}
