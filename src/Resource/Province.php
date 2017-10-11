<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/province
 *
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 */
class Province extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'countries/%s/provinces/%s.json',
            'resourceKey' => 'province',
            'responseKey' => 'province',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'countries/%s/provinces.json',
            'resourceKey' => 'provinces',
            'responseKey' => 'provinces',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'countries/%s/provinces/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'countries/%s/provinces/%s.json',
            'resourceKey' => 'province',
            'responseKey' => 'province',
        ],
    ];
}
