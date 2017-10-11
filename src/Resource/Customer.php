<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customer
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 *
 * @property ProductMetaField $metafields
 * @property CustomerAddress $addresses
 */
class Customer extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'customers.json',
            'resourceKey' => 'customer',
            'responseKey' => 'customer',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'customers/%s.json',
            'resourceKey' => 'customer',
            'responseKey' => 'customer',
        ],
        'search' => [
            'method'      => 'GET',
            'endpoint'    => 'customers/search.json',
            'responseKey' => 'customers',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'customers.json',
            'resourceKey' => 'customers',
            'responseKey' => 'customers',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'customers/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'customers/%s.json',
            'resourceKey' => 'customer',
            'responseKey' => 'customer',
        ],
        'orders' => [
            'method'      => 'GET',
            'endpoint'    => 'customers/%s/orders.json',
            'responseKey' => 'orders',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'customers/%s.json',
        ],
    ];

    protected $childResources = [
        'metafields' => CustomerMetaField::class,
        'addresses'  => CustomerAddress::class,
    ];
}
