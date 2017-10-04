<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customeraddress
 */
class CustomerAddress extends AbstractResource
{
    /**
     * @param float $customerId
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $customerId, float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/customers/%s/addresses/%s.json', $customerId, $id), [
            'query' => [
                'fields' => $fields,
            ],
        ]);

        return $response['customer_address'];
    }

    /**
     * @param float $id customer id
     * @param array $query
     * @return array
     */
    public function all(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/customers/%s/addresses.json', $id), [
            'query' => $query,
        ]);

        return $response['addresses'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function create(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/customers/%s/addresses.json', $id), [
            'body' => json_encode(['address' => $params]),
        ]);

        return $response['customer_address'];
    }

    /**
     * @param float $customerId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $customerId, float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/customers/%s/addresses/%s.json', $customerId, $id), [
            'body' => json_encode(['address' => $params]),
        ]);

        return $response['customer_address'];
    }

    /**
     * @param float $customerId
     * @param float $id
     */
    public function delete(float $customerId, float $id)
    {
        $this->request('DELETE', sprintf('/admin/customers/%s/addresses/%s.json', $customerId, $id));
    }
}
