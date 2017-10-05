<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/country
 */
class Country extends AbstractResource
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
        $response = $this->request('GET', sprintf('/admin/countries/%s.json', $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['country'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response = $this->request('GET', '/admin/countries.json', [
            'query' => $query
        ]);

        return $response['countries'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response = $this->request('GET', '/admin/countries/count.json', [
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
        $response = $this->request('POST', '/admin/countries.json', [
            'body' => json_encode([
                'country' => $params,
            ]),
        ]);

        return $response['country'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/countries/%s.json', $id), [
            'body' => json_encode([
                'country' => $params,
            ]),
        ]);

        return $response['country'];
    }

    /**
     * @param float $id
     */
    public function delete(float $id)
    {
        $this->request('DELETE', sprintf('/admin/countries/%s.json', $id));
    }
}
