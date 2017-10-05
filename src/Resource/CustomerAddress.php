<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customeraddress
 */
class CustomerAddress extends AbstractNestedCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'customers';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'addresses';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'customer_address';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'addresses';
}
