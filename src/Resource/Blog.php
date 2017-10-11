<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/blog
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 *
 * @property BlogMetaField $metafields
 * @property Article $articles
 */
class Blog extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'blogs.json',
            'resourceKey' => 'blog',
            'responseKey' => 'blog',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s.json',
            'resourceKey' => 'blog',
            'responseKey' => 'blog',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'blogs.json',
            'resourceKey' => 'blogs',
            'responseKey' => 'blogs',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'blogs/%s.json',
            'resourceKey' => 'blog',
            'responseKey' => 'blog',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'blogs/%s.json',
        ],
    ];

    protected $childResources = [
        'metafields' => BlogMetaField::class,
        'articles'   => Article::class,
    ];
}
