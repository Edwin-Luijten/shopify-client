<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/product_variant
 */
class ProductVariant extends AbstractResource
{
    /**
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/variants/%s.json', $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['variant'];
    }

    /**
     * @param float $id product id
     * @param array $query
     * @return array
     */
    public function all(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/products/%s/variants.json', $id), [
            'query' => $query
        ]);

        return $response['variants'];
    }

    /**
     * @param int $id product id
     * @return array
     */
    public function count(int $id)
    {
        $response = $this->request('GET', sprintf('/admin/products/%s/variants/count.json', $id));

        return $response['count'];
    }

    /**
     * @param int $id product id
     * @param array $params
     * @return array
     */
    public function create(int $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/products/%s/variants.json', $id), [
            'form_params' => $params
        ]);

        return $response['variant'];
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function update(int $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/variants/%s.json', $id), [
            'form_params' => $params
        ]);

        return $response['variant'];
    }

    /**
     * @param int $productId
     * @param int $variantId
     */
    public function delete(int $productId, int $variantId)
    {
        $this->request('DELETE', sprintf('/admin/products/%s/variants/%s.json', $productId, $variantId));
    }
}
