<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/pricerule
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 *
 * @property DiscountCode $discountCode
 */
class PriceRule extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'discountCodes' => DiscountCode::class,
    ];

    /**
     * PriceRule constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'price_rules.json',
                'price_rule',
                'price_rule'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'price_rules/%s.json',
                'price_rule',
                'price_rule'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'price_rules.json',
                'price_rules',
                'price_rules'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'price_rules/%s.json',
                'price_rule',
                'price_rule'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'price_rules/%s.json'
            )
        );
    }
}
