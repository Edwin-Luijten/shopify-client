<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/customer
 */
class Customer extends AbstractResource
{
    /**
     * @param int $id
     * @param array $fields
     * @return array
     */
    public function get(int $id, array $fields = [])
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
        $response = $this->request('GET', '/admin/search.json', [
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
        $response =  $this->request('POST', '/admin/customers.json', [
            'form_params' => $params
        ]);

        return $response['customer'];
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function update(int $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/customers/%s.json', $id), [
            'form_params' => $params
        ]);

        return $response['customer'];
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->request('DELETE', sprintf('/admin/customers/%s.json', $id));
    }

    /**
     * @param int $id
     * @return array
     */
    public function orders(int $id)
    {
        $response =  $this->request('GET', sprintf('/admin/customers/%s/orders.json', $id));

        return $response['orders'];
    }
}
