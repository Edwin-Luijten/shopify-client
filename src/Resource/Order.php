<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/order
 */
class Order extends AbstractResource
{
    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @param int $id
     * @param array $fields
     * @return array
     */
    public function get(int $id, array $fields = [])
    {
        $response =  $this->request('GET', sprintf('/admin/orders/%s.json', $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['order'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response =  $this->request('GET', '/admin/orders.json', [
            'query' => $query
        ]);

        return $response['orders'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response =  $this->request('GET', '/admin/orders/count.json', [
            'query' => $query
        ]);

        return $response['count'];
    }

    /**
     * @param int $id
     * @return array
     */
    public function open(int $id)
    {
        $response =  $this->request('POST', sprintf('/admin/orders/%s/open.json', $id));

        return $response['order'];
    }

    /**
     * @param int $id
     * @return array
     */
    public function close(int $id)
    {
        $response =  $this->request('POST', sprintf('/admin/orders/%s/close.json', $id));

        return $response['order'];
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function cancel(int $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/orders/%s/cancel.json', $id), [
            'form_params' => $params
        ]);

        return $response['order'];
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params = [])
    {
        $response =  $this->request('POST', '/admin/orders.json', [
            'form_params' => $params
        ]);

        return $response['order'];
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function update(int $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/orders/%s.json', $id), [
            'form_params' => $params
        ]);

        return $response['order'];
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->request('DELETE', sprintf('/admin/orders/%s.json', $id));
    }
}
