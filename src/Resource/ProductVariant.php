<?php

namespace ShopifyClient\Resource;

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
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'products/%s/variants.json',
            'resourceKey' => 'variant',
            'responseKey' => 'variant',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'variants/%s.json',
            'resourceKey' => 'variant',
            'responseKey' => 'variant',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/variants.json',
            'resourceKey' => 'variants',
            'responseKey' => 'variants',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/variants/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'variants/%s.json',
            'resourceKey' => 'variant',
            'responseKey' => 'variant',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'products/%s/variants/%s.json',
        ],
    ];

    protected $childResources = [
        'metafields' => ProductVariantMetaField::class,
    ];
}
