<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/discountcode
 */
class DiscountCode extends AbstractNestedCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'price_rules';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'discount_codes';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'discount_code';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'discount_codes';

    /**
     * @param string $code
     * @return array|null
     */
    public function lookUp(string $code)
    {
        $response = $this->request('GET', sprintf('/admin/discount_codes/lookup.json'), [
            'query' => [
                'code' => $code,
            ],
        ]);

        if (empty($response)) {
            return null;
        }

        return $response['discount_code'];
    }

    /**
     * @param float $parentId
     * @param array $params
     * @return array
     */
    public function createBatch(float $parentId, array $params = [])
    {
        $response = $this->request('GET', sprintf('/admin/price_rules/%s/batch.json', $parentId), [
            'body' => json_encode([
                $this->resourceChildKeySingular => $params,
            ]),
        ]);

        return $response['discount_code_creation'];
    }

    /**
     * @param float $parentId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function getBatchAll(float $parentId, float $id, array $params = [])
    {
        $response = $this->request('GET', sprintf('/admin/price_rules/%s/batch/%s/discount_codes.json', $parentId, $id),
            [
                'body' => json_encode([
                    $this->resourceChildKeySingular => $params,
                ]),
            ]);

        return $response['discount_codes'];
    }

    /**
     * @param float $parentId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function getBatch(float $parentId, float $id, array $params = [])
    {
        $response = $this->request('GET', sprintf('/admin/price_rules/%s/batch/%s.json', $parentId, $id), [
            'body' => json_encode([
                $this->resourceChildKeySingular => $params,
            ]),
        ]);

        return $response['discount_code_creation'];
    }
}
