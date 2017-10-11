<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Exception\ResourceException;
use ShopifyClient\Request;

class ResourceCollection
{
    private $defaultResources = [
        'abandonedCheckouts'  => AbandonedCheckouts::class,
        'blogs'               => Blog::class,
        'countries'           => Country::class,
        'customers'           => Customer::class,
        'fulfillmentServices' => FulfillmentService::class,
        'priceRules'          => PriceRule::class,
        'products'            => Product::class,
        'orders'              => Order::class,
        'shop'                => Shop::class,
        'webhooks'            => Webhook::class,
    ];

    /**
     * @var array
     */
    private $resources = [];

    /**
     * ResourceCollection constructor.
     * @param Request $request
     * @param array $resources
     */
    public function __construct(Request $request, array $resources = [])
    {
        $resources = array_merge($this->defaultResources, $resources);

        $this->loadResources($request, $resources);
    }

    /**
     * @param string $key
     * @return Resource
     * @throws ResourceException
     */
    public function getResource(string $key)
    {
        if (!isset($this->resources[$key])) {
            throw new ResourceException(sprintf('Resource %s does not exist.', $key));
        }

        return $this->resources[$key];
    }

    /**
     * @param Request $request
     * @param array $resources
     */
    private function loadResources(Request $request, array $resources)
    {
        foreach ($resources as $key => $resource) {
            $this->loadResource($request, $key, $resource);
        }
    }

    /**
     * @param Request $request
     * @param string $key
     * @param string $resource
     */
    private function loadResource(Request $request, string $key, string $resource)
    {
        $this->resources[$key] = ResourceFactory::build($request, $resource);
    }
}
