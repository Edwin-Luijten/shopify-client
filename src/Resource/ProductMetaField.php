<?php

namespace ShopifyClient\Resource;

/**
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId, array $parameters = [])
 * @method all(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId)
 */
class ProductMetaField extends MetaField implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'products/%s/metafields.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/metafields.json',
            'resourceKey' => 'metafields',
            'responseKey' => 'metafields',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/metafields/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'products/%s/metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'products/%s/metafields/%s.json',
        ],
    ];
}
