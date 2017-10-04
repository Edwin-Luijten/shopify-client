<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/product_image
 */
class ProductImage extends AbstractResource
{
    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @param float $productId
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $productId, float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/products/%s/images/%s.json', $productId, $id), [
            'query' => [
                'fields' => $fields,
            ],
        ]);

        return $response['image'];
    }

    /**
     * @param float $id product id
     * @param array $query
     * @return array
     */
    public function all(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/products/%s/images.json', $id), [
            'query' => $query,
        ]);

        return $response['images'];
    }

    /**
     * @param float $id product id
     * @return array
     */
    public function count(float $id)
    {
        $response = $this->request('GET', sprintf('/admin/products/%s/images/count.json', $id));

        return $response['count'];
    }

    /**
     * @param float $id product id
     * @param array $params
     * @return array
     */
    public function create(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/products/%s/images.json', $id), [
            'body' => json_encode([
                'image' => $params,
            ]),
        ]);

        return $response['image'];
    }

    /**
     * @param float $productId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $productId, float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/products/%s/images/%s.json', $productId, $id), [
            'body' => json_encode([
                'image' => $params,
            ]),
        ]);

        return $response['image'];
    }

    /**
     * @param float $productId
     * @param float $id
     */
    public function delete(float $productId, float $id)
    {
        $this->request('DELETE', sprintf('/admin/products/%s/images/%s.json', $productId, $id));
    }
}
