<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/product
 */
class Product extends AbstractResource
{
    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @var ProductVariant
     */
    public $variants;

    /**
     * @var ProductImage
     */
    public $images;

    /**
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/products/%s.json', $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['product'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response = $this->request('GET', '/admin/products.json', [
            'query' => $query
        ]);

        return $response['products'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response = $this->request('GET', '/admin/products/count.json', [
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
        $response = $this->request('POST', '/admin/products.json', [
            'body' => json_encode([
                'product' => $params,
            ]),
        ]);

        return $response['product'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/products/%s.json', $id), [
            'body' => json_encode([
                'product' => $params,
            ]),
        ]);

        return $response['product'];
    }

    /**
     * @param float $id
     */
    public function delete(float $id)
    {
        $this->request('DELETE', sprintf('/admin/products/%s.json', $id));
    }
}
