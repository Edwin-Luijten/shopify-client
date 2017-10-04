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
     * @var OrderRisk
     */
    public $risks;

    /**
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/orders/%s.json', $id), [
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
        $response = $this->request('GET', '/admin/orders.json', [
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
        $response = $this->request('GET', '/admin/orders/count.json', [
            'query' => $query
        ]);

        return $response['count'];
    }

    /**
     * @param float $id
     * @return array
     */
    public function open(float $id)
    {
        $response = $this->request('POST', sprintf('/admin/orders/%s/open.json', $id));

        return $response['order'];
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

        return $response['order'];
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

        return $response['order'];
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params = [])
    {
        $response = $this->request('POST', '/admin/orders.json', [
            'body' => json_encode([
                'order' => $params,
            ]),
        ]);

        return $response['order'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/orders/%s.json', $id), [
            'body' => json_encode([
                'order' => $params,
            ]),
        ]);

        return $response['order'];
    }

    /**
     * @param float $id
     */
    public function delete(float $id)
    {
        $this->request('DELETE', sprintf('/admin/orders/%s.json', $id));
    }
}
