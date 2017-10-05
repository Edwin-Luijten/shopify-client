<?php

namespace ShopifyClient;

use GuzzleHttp\ClientInterface;
use ShopifyClient\Exception\ResourceException;
use ShopifyClient\Resource\AbandonedCheckout;
use ShopifyClient\Resource\ApplicationCharge;
use ShopifyClient\Resource\Article;
use ShopifyClient\Resource\Blog;
use ShopifyClient\Resource\CarrierService;
use ShopifyClient\Resource\Country;
use ShopifyClient\Resource\Customer;
use ShopifyClient\Resource\CustomerAddress;
use ShopifyClient\Resource\Order;
use ShopifyClient\Resource\OrderRisk;
use ShopifyClient\Resource\Product;
use ShopifyClient\Resource\ProductImage;
use ShopifyClient\Resource\ProductVariant;
use ShopifyClient\Resource\Resource;
use ShopifyClient\Resource\Shop;
use ShopifyClient\Resource\Webhook;

class ResourceCollection
{
    private $defaultResources = [
        'abandonedCheckouts' => [
            'class' => AbandonedCheckout::class,
        ],
        'blog'               => [
            'class'     => Blog::class,
            'resources' => [
                'articles' => [
                    'class' => Article::class,
                ],
            ]
        ],
        'carrierServices'    => [
            'class' => CarrierService::class,
        ],
        'countries'          => [
            'class' => Country::class,
        ],
        'customers'          => [
            'class'     => Customer::class,
            'resources' => [
                'addresses' => [
                    'class' => CustomerAddress::class,
                ],
            ],
        ],
        'orders'             => [
            'class'     => Order::class,
            'resources' => [
                'risks' => [
                    'class' => OrderRisk::class,
                ],
            ],
        ],
        'products'           => [
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
        'shop'               => [
            'class' => Shop::class,
        ],
        'webhooks'           => [
            'class' => Webhook::class,
        ],
    ];

    /**
     * @var array
     */
    private $resources = [];

    /**
     * ResourceCollection constructor.
     * @param ClientInterface $httpClient
     * @param array $resources
     */
    public function __construct(ClientInterface $httpClient, array $resources = [])
    {
        $resources = array_merge($this->defaultResources, $resources);

        $this->validateResources($resources);
        $this->loadResources($httpClient, $resources);
    }

    /**
     * @param string $key
     * @return Resource
     * @throws ResourceException
     */
    public function getResource(string $key): Resource
    {
        if (!isset($this->resources[$key])) {
            throw new ResourceException(sprintf('Resources %s does not exist', $key));
        }

        return $this->resources[$key];
    }

    /**
     * @param array $resources
     * @throws ResourceException
     */
    private function validateResources(array $resources)
    {
        foreach ($resources as $key => $resource) {
            if (!is_array($resource)) {
                throw new ResourceException(sprintf('Resource should be an array for resource %s', $key));
            }

            $this->validateResource($key, $resource);
        }
    }

    /**
     * @param string $key
     * @param array $resource
     * @throws ResourceException
     */
    private function validateResource(string $key, array $resource)
    {
        if (!array_key_exists('class', $resource)) {
            throw new ResourceException(sprintf('Required key "class" is missing for resource %s.', $key));
        }

        if (isset($resource['resources'])) {
            $this->validateResources($resource['resources']);
        }
    }

    /**
     * @param ClientInterface $httpClient
     * @param array $resources
     */
    private function loadResources(ClientInterface $httpClient, array $resources)
    {
        foreach ($resources as $key => $resource) {
            if (array_key_exists($key, $resources)) {
                $this->loadResource($key, $resource, $httpClient);
            }
        }
    }

    /**
     * @param $key
     * @param $resource
     * @param $httpClient
     */
    private function loadResource($key, $resource, $httpClient)
    {
        $this->resources[$key] = new $resource['class']($httpClient);

        if (isset($resource['resources'])) {
            $this->loadSubResources($key, $resource, $httpClient);
        }
    }

    /**
     * @param $key
     * @param $resource
     * @param $httpClient
     */
    private function loadSubResources($key, $resource, $httpClient)
    {
        foreach ($resource['resources'] as $subKey => $subResource) {
            $this->loadSubResource($key, $subKey, $subResource, $httpClient);
        }
    }

    /**
     * @param $parent
     * @param $key
     * @param $resource
     * @param $httpClient
     */
    private function loadSubResource($parent, $key, $resource, $httpClient)
    {
        if (property_exists($this->resources[$parent], $key)) {
            $this->resources[$parent]->{$key} = new $resource['class']($httpClient);
        }
    }
}
