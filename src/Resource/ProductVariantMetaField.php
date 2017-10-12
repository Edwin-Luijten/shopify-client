<?php

namespace ShopifyClient\Resource;

/**
 * @method create(float $parentId, float $childId, array $parameters = [])
 * @method get(float $parentId, float $childId, float $childChildId, array $parameters = [])
 * @method all(float $parentId, float $childId, array $parameters = [])
 * @method count(float $parentId, float $childId)
 * @method update(float $parentId, float $childId, float $childChildId, array $parameters = [])
 * @method delete(float $parentId, float $childId, float $childChildId)
 */
class ProductVariantMetaField extends MetaField implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'products/%s/variants/%s/metafields.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/variants/%s/metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/variants/%s/metafields.json',
            'resourceKey' => 'metafields',
            'responseKey' => 'metafields',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/variants/%s/metafields/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'products/%s/variants/%s/metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'products/%s/variants/%s/metafields/%s.json',
        ],
    ];
}
