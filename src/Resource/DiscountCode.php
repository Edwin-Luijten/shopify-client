<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/discountcode
 *
 * @method create(array $parameters = [])
 * @method createBatch(float $parentId, array $parameters = [])
 * @method get(float $parentId)
 * @method getBatch(float $parentId, float $childId)
 * @method all(float $parentId)
 * @method allBatch(float $parentId, float $childId)
 * @method lookup(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 */
class DiscountCode extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'price_rules/%s/discount_codes.json',
            'resourceKey' => 'discount_code',
            'responseKey' => 'discount_code',
        ],
        'createBatch' => [
            'method'      => 'POST',
            'endpoint'    => 'price_rules/%s/batch.json',
            'resourceKey' => 'discount_codes',
            'responseKey' => 'discount_code_creation',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'price_rules/%s/discount_codes/%s.json',
            'resourceKey' => 'discount_code',
            'responseKey' => 'discount_code',
        ],
        'getBatch'    => [
            'method'      => 'GET',
            'endpoint'    => 'price_rules/%s/batch/%s.json',
            'resourceKey' => 'discount_code_creation',
            'responseKey' => 'discount_code_creation',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'price_rules/%s/discount_codes.json',
            'resourceKey' => 'discount_codes',
            'responseKey' => 'discount_codes',
        ],
        'allBatch' => [
            'method'      => 'GET',
            'endpoint'    => 'price_rules/%s/batch/%s/discount_codes.json',
            'resourceKey' => 'discount_codes',
            'responseKey' => 'discount_codes',
        ],
        'lookup' => [
            'method'      => 'GET',
            'endpoint'    => 'discount_codes/lookup.json',
            'resourceKey' => 'discount_code',
            'responseKey' => 'discount_code',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'price_rules/%s/discount_codes/%s.json',
            'resourceKey' => 'discount_code',
            'responseKey' => 'discount_code',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'price_rules/%s/discount_codes/%s.json',
        ],
    ];
}
