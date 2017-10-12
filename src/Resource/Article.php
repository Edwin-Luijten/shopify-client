<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/article
 *
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method tags(float $parentId, array $parameters = [])
 * @method authors
 * @method delete(float $parentId, float $childId)
 *
 * @property ArticleMetaField $metafields
 * @property CustomerAddress $addresses
 */
class Article extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create'  => [
            'method'      => 'POST',
            'endpoint'    => 'blogs/%s/articles.json',
            'resourceKey' => 'article',
            'responseKey' => 'article',
        ],
        'get'     => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles/%s.json',
            'resourceKey' => 'article',
            'responseKey' => 'article',
        ],
        'all'     => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles.json',
            'resourceKey' => 'articles',
            'responseKey' => 'articles',
        ],
        'count'   => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update'  => [
            'method'      => 'PUT',
            'endpoint'    => 'blogs/%s/articles/%s.json',
            'resourceKey' => 'article',
            'responseKey' => 'article',
        ],
        'tags'    => [
            'method'      => 'GET',
            'endpoint'    => 'blogs/%s/articles/tags.json',
            'resourceKey' => 'tags',
            'responseKey' => 'tags',
        ],
        'authors' => [
            'method'      => 'GET',
            'endpoint'    => 'articles/authors.json',
            'resourceKey' => 'authors',
            'responseKey' => 'authors',
        ],
        'delete'  => [
            'method'   => 'DELETE',
            'endpoint' => 'blogs/%s/articles/%s.json',
        ],
    ];

    protected $childResources = [
        'metafields' => ArticleMetaField::class,
    ];
}
