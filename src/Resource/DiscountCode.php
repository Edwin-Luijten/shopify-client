<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
     * DiscountCode constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'price_rules/%s/discount_codes.json',
                'discount_code',
                'discount_code'
            )
        );
        $this->actions->add(
            'createBatch',
            new Action(
                Request::METHOD_POST,
                'price_rules/%s/batch.json',
                'discount_code_creation',
                'discount_codes'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'price_rules/%s/discount_codes/%s.json',
                'discount_code',
                'discount_code'
            )
        );
        $this->actions->add(
            'getBatch',
            new Action(
                Request::METHOD_GET,
                'price_rules/%s/batch/%s.json',
                'discount_code_creation',
                'discount_code_creation'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'price_rules/%s/discount_codes.json',
                'discount_codes',
                'discount_codes'
            )
        );
        $this->actions->add(
            'allBatch',
            new Action(
                Request::METHOD_GET,
                'price_rules/%s/batch/%s/discount_codes.json',
                'discount_codes',
                'discount_codes'
            )
        );
        $this->actions->add(
            'lookup',
            new Action(
                Request::METHOD_GET,
                'discount_codes/lookup.json',
                'discount_code',
                'discount_code'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'price_rules/%s/discount_codes/%s.json',
                'discount_code',
                'discount_code'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'price_rules/%s/discount_codes/%s.json'
            )
        );
    }
}
