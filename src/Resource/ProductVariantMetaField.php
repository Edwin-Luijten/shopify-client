<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
     * ProductVariantMetaField constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'products/%s/variants/%s/metafields.json',
                'metafield',
                'metafield'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'products/%s/variants/%s/metafields/%s.json',
                'metafield',
                'metafield'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'products/%s/variants/%s/metafields.json',
                'metafields',
                'metafields'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'products/%s/variants/%s/metafields/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'products/%s/variants/%s/metafields/%s.json',
                'metafield',
                'metafield'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'products/%s/variants/%s/metafields/%s.json'
            )
        );
    }
}
