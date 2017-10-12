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
class ShopMetaField extends MetaField implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'metafields.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'metafields.json',
            'resourceKey' => 'metafields',
            'responseKey' => 'metafields',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'metafields/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'metafields/%s.json',
        ],
    ];
}
