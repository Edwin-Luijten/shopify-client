<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customer
 */
class Customer extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'customer';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'customers';

    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @var CustomerAddress
     */
    public $addresses;

    /**
     * @param array $query
     * @return mixed
     */
    public function search(array $query = [])
    {
        $response = $this->request('GET', '/admin/customers/search.json', [
            'query' => $query
        ]);

        return $response['customers'];
    }

    /**
     * @param float $id
     * @return array
     */
    public function orders(float $id)
    {
        $response = $this->request('GET', sprintf('/admin/customers/%s/orders.json', $id));

        return $response['orders'];
    }
}
