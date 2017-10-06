<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/order
 */
class Order extends AbstractCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'order';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'orders';

    /**
     * @var OrderRisk
     */
    public $risks;

    /**
     * @var Fulfillment
     */
    public $fulfillments;
    
    /**
     * @param float $id
     * @return array
     */
    public function open(float $id)
    {
        $response = $this->request('POST', sprintf('/admin/orders/%s/open.json', $id));

        return $response[$this->resourceKeySingular];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function close(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/orders/%s/close.json', $id), [
            'body' => json_encode($params)
        ]);

        return $response[$this->resourceKeySingular];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function cancel(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/orders/%s/cancel.json', $id), [
            'body' => json_encode($params)
        ]);

        return $response[$this->resourceKeySingular];
    }
}
