<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/province
 */
class Province extends AbstractResource
{
    /**
     * @param float $countryId
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $countryId, float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/countries/%s/provinces/%s.json', $countryId, $id), [
            'query' => [
                'fields' => $fields,
            ],
        ]);

        return $response['province'];
    }

    /**
     * @param float $id country id
     * @param array $query
     * @return array
     */
    public function all(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/countries/%s/provinces.json', $id), [
            'query' => $query,
        ]);

        return $response['provinces'];
    }

    /**
     * @param float $id country id
     * @return array
     */
    public function count(float $id)
    {
        $response = $this->request('GET', sprintf('/admin/countries/%s/provinces/count.json', $id));

        return $response['count'];
    }

    /**
     * @param float $countryId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $countryId, float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/countries/%s/provinces/%s.json', $countryId, $id), [
            'body' => json_encode([
                'province' => $params,
            ]),
        ]);

        return $response['province'];
    }
}
