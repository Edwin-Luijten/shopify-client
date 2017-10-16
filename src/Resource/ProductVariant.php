<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/product_variant
 *
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $childId)
 * @method all(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId)
 *
 * @property ProductVariantMetaField $metafields
 */
class ProductVariant extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'metafields' => ProductVariantMetaField::class,
    ];

    /**
     * ProductVariant constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'products/%s/variants.json',
                'variant',
                'variant'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'variants/%s.json',
                'variant',
                'variant'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'products/%s/variants.json',
                'variants',
                'variants'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'products/%s/variants/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'variants/%s.json',
                'variant',
                'variant'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'products/%s/variants/%s.json'
            )
        );
    }
}
