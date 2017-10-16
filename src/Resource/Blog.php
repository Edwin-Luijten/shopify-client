<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
    protected $childResources = [
        'metafields' => BlogMetaField::class,
        'articles'   => Article::class,
    ];

    /**
     * Blog constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'blogs.json',
                'blog',
                'blog'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'blogs/%s.json',
                'blog',
                'blog'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'blogs.json',
                'blogs',
                'blogs'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'blogs/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'blogs/%s.json',
                'blog',
                'blog'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'blogs/%s.json'
            )
        );
    }
}
