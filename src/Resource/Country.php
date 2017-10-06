<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/country
 */
class Country extends AbstractCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'country';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'countries';

    /**
     * @var Province
     */
    public $provinces;
}
