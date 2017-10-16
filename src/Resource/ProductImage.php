<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/product_image
 *
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId)
 */
class ProductImage extends AbstractResource implements Resource
{
    /**
     * ProductImage constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'products/%s/images.json',
                'image',
                'image'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'products/%s/images/%s.json',
                'image',
                'image'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'products/%s/images.json',
                'images',
                'images'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'products/%s/images/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'products/%s/images/%s.json',
                'image',
                'image'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'products/%s/images/%s.json'
            )
        );
    }
}
