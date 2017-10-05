<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/country
 */
class Country extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'country';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'countries';
}
