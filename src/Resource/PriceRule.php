<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/pricerule
 */
class PriceRule extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'price_rule';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'price_rules';

    /**
     * @var DiscountCode
     */
    public $discountCodes;
}
