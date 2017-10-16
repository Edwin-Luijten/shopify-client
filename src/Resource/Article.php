<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
    protected $childResources = [
        'metafields' => ArticleMetaField::class,
    ];

    /**
     * Article constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'blogs/%s/articles.json',
                'article',
                'article'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles/%s.json',
                'article',
                'article'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles.json',
                'articles',
                'articles'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'blogs/%s/articles/%s.json',
                'article',
                'article'
            )
        );
        $this->actions->add(
            'tags',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles/tags.json',
                'tags',
                'tags'
            )
        );
        $this->actions->add(
            'authors',
            new Action(
                Request::METHOD_GET,
                'articles/authors.json',
                'authors',
                'authors'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'blogs/%s/articles/%s.json'
            )
        );
    }
}
