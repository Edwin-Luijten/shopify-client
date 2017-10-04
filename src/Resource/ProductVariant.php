<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/product_variant
 */
class ProductVariant extends AbstractResource
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
        $response = $this->request('GET', sprintf('/admin/variants/%s.json', $id), [
            'query' => [
                'fields' => $fields,
            ],
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
            'query' => $query,
        ]);

        return $response['variants'];
    }

    /**
     * @param float $id product id
     * @return array
     */
    public function count(float $id)
    {
        $response = $this->request('GET', sprintf('/admin/products/%s/variants/count.json', $id));

        return $response['count'];
    }

    /**
     * @param float $id product id
     * @param array $params
     * @return array
     */
    public function create(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/products/%s/variants.json', $id), [
            'body' => json_encode([
                'variant' => $params,
            ]),
        ]);

        return $response['variant'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/variants/%s.json', $id), [
            'body' => json_encode([
                'variant' => $params,
            ]),
        ]);

        return $response['variant'];
    }

    /**
     * @param float $productId
     * @param float $variantId
     */
    public function delete(float $productId, float $variantId)
    {
        $this->request('DELETE', sprintf('/admin/products/%s/variants/%s.json', $productId, $variantId));
    }
}
