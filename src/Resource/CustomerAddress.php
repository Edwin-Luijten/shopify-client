<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customeraddress
 *
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId, array $parameters = [])
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId)
 */
class CustomerAddress extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'customers/%s/addresses.json',
            'resourceKey' => 'address',
            'responseKey' => 'customer_address',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'customers/%s/addresses/%s.json',
            'resourceKey' => 'customer_address',
            'responseKey' => 'customer_address',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'customers/%s/addresses.json',
            'resourceKey' => 'addresses',
            'responseKey' => 'addresses',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'customers/%s/addresses/%s.json',
            'resourceKey' => 'address',
            'responseKey' => 'customer_address',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'customers/%s/addresses/%s.json',
        ],
    ];
}
