<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/product
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 *
 * @property ProductMetaField $metafields
 * @property ProductVariant $variants
 * @property ProductImage $images
 */
class Product extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'metafields' => ProductMetaField::class,
        'variants'   => ProductVariant::class,
        'images'     => ProductImage::class,
    ];

    /**
     * Product constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'products.json',
                'product',
                'product'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'products/%s.json',
                'product',
                'product'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'products.json',
                'products',
                'products'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'products/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'products/%s.json',
                'product',
                'product'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'products/%s.json'
            )
        );
    }
}
