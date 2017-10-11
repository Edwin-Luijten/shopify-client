<?php

namespace ShopifyClient\Resource;

/**
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId, float $childChildId, array $parameters = [])
 * @method all(float $parentId, float $childId, array $parameters = [])
 * @method count(float $parentId, float $childId)
 * @method update(float $parentId, float $childId, float $childChildId, array $parameters = [])
 * @method delete(float $parentId, float $childId, float $childChildId)
 */
class ArticleMetaField extends MetaField implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'blogs/%s/articles/%s/metafields.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles/%s/metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles/%s/metafields.json',
            'resourceKey' => 'metafields',
            'responseKey' => 'metafields',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles/%s/metafields/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'blogs/%s/articles/%s/metafields/%s.json',
            'resourceKey' => 'metafield',
            'responseKey' => 'metafield',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'blogs/%s/articles/%s/metafields/%s.json',
        ],
    ];
}
