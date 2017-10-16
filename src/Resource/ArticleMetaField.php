<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
     * ArticleMetaField constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'blogs/%s/articles/%s/metafields.json',
                'metafield',
                'metafield'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles/%s/metafields/%s.json',
                'metafield',
                'metafield'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles/%s/metafields.json',
                'metafields',
                'metafields'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'blogs/%s/articles/%s/metafields/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'blogs/%s/articles/%s/metafields/%s.json',
                'metafield',
                'metafield'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'blogs/%s/articles/%s/metafields/%s.json'
            )
        );
    }
}
