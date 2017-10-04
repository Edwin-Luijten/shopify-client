<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/order_risks
 */
class OrderRisk extends AbstractResource
{
    /**
     * @param float $orderId
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $orderId, float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/orders/%s/risks/%s.json', $orderId, $id), [
            'query' => [
                'fields' => $fields,
            ],
        ]);

        return $response['risk'];
    }

    /**
     * @param float $id
     * @param array $query
     * @return array
     */
    public function all(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/orders/%s/risks.json', $id), [
            'query' => $query,
        ]);

        return $response['risks'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function create(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/orders/%s/risks.json', $id), [
            'body' => json_encode([
                'risk' => $params,
            ]),
        ]);

        return $response['risk'];
    }

    /**
     * @param float $orderId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $orderId, float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/orders/%s/risks/%s.json', $orderId, $id), [
            'body' => json_encode([
                'risk' => $params,
            ]),
        ]);

        return $response['risk'];
    }

    /**
     * @param float $orderId
     * @param float $id
     */
    public function delete(float $orderId, float $id)
    {
        $this->request('DELETE', sprintf('/admin/orders/%s/risks/%s.json', $orderId, $id));
    }
}
