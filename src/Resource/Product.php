<?php

namespace ShopifyClient\Resource;

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
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'products.json',
            'resourceKey' => 'product',
            'responseKey' => 'product',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s.json',
            'resourceKey' => 'product',
            'responseKey' => 'product',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'products.json',
            'resourceKey' => 'products',
            'responseKey' => 'products',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'products/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'products/%s.json',
            'resourceKey' => 'product',
            'responseKey' => 'product',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'products/%s.json',
        ],
    ];

    /**
     * @var array
     */
    protected $childResources = [
        'metafields' => ProductMetaField::class,
        'variants'   => ProductVariant::class,
        'images'     => ProductImage::class,
    ];
}
