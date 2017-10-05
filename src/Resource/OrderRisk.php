<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/order_risks
 */
class OrderRisk extends AbstractNestedCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'orders';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'risks';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'risk';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'risks';
}
