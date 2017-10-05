<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/carrierservice
 */
class CarrierService extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'carrier_service';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'carrier_services';
}
