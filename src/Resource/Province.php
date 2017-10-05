<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/province
 */
class Province extends AbstractNestedCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'countries';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'provinces';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'province';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'provinces';
}
