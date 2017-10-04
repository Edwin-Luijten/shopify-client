<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/shop
 */
class Shop extends AbstractResource
{
    /**
     * @param array $fields
     * @return array
     */
    public function get(array $fields = [])
    {
        $response = $this->request('GET', '/admin/shop.json', [
            'query' => [
                'fields' => $fields,
            ],
        ]);

        return $response['shop'];
    }
}
