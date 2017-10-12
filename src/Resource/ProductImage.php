<?php

namespace ShopifyClient\Resource;

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
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'products/%s/images.json',
            'resourceKey' => 'image',
            'responseKey' => 'image',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/images/%s.json',
            'resourceKey' => 'image',
            'responseKey' => 'image',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/images.json',
            'resourceKey' => 'images',
            'responseKey' => 'images',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'products/%s/images/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'products/%s/images/%s.json',
            'resourceKey' => 'image',
            'responseKey' => 'image',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'products/%s/images/%s.json',
        ],
    ];
}
