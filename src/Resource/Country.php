<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/country
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 */
class Country extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'countries.json',
            'resourceKey' => 'country',
            'responseKey' => 'country',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'countries/%s.json',
            'resourceKey' => 'country',
            'responseKey' => 'country',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'countries.json',
            'resourceKey' => 'countries',
            'responseKey' => 'countries',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'countries/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'countries/%s.json',
            'resourceKey' => 'country',
            'responseKey' => 'country',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'countries/%s.json',
        ],
    ];

    /**
     * @var array
     */
    protected $childResources = [
        'provinces' => Province::class,
    ];
}
