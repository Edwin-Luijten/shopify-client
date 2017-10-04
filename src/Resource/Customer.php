<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customer
 */
class Customer extends AbstractResource
{
    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @var CustomerAddress
     */
    public $addresses;

    /**
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/customers/%s.json', $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['customer'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response = $this->request('GET', '/admin/customers.json', [
            'query' => $query
        ]);

        return $response['customers'];
    }

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
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response = $this->request('GET', '/admin/customers/count.json', [
            'query' => $query
        ]);

        return $response['count'];
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params = [])
    {
        $response = $this->request('POST', '/admin/customers.json', [
            'body' => json_encode(['customer' => $params])
        ]);

        return $response['customer'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/customers/%s.json', $id), [
            'body' => json_encode(['customer' => $params])
        ]);

        return $response['customer'];
    }

    /**
     * @param float $id
     */
    public function delete(float $id)
    {
        $this->request('DELETE', sprintf('/admin/customers/%s.json', $id));
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
