<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/webhook
 */
class Webhook extends AbstractResource
{
    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/webhooks/%s.json', $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['webhook'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response = $this->request('GET', '/admin/webhooks.json', [
            'query' => $query
        ]);

        return $response['webhooks'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response = $this->request('GET', '/admin/webhooks/count.json', [
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
        $response = $this->request('POST', '/admin/webhooks.json', [
            'body' => json_encode([
                'webhook' => $params,
            ]),
        ]);

        return $response['webhook'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/webhooks/%s.json', $id), [
            'body' => json_encode([
                'webhook' => $params,
            ]),
        ]);

        return $response['webhook'];
    }

    /**
     * @param float $id
     */
    public function delete(float $id)
    {
        $this->request('DELETE', sprintf('/admin/webhooks/%s.json', $id));
    }
}
