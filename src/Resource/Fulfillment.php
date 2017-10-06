<?php

namespace ShopifyClient\Resource;

class Fulfillment extends AbstractNestedCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'orders';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'fulfillments';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'fulfillment';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'fulfillments';

    /**
     * @param float $parentId
     * @param float $id
     * @return array
     */
    public function complete(float $parentId, float $id): array
    {
        return $this->changeStatus('complete', $parentId, $id);
    }

    /**
     * @param float $parentId
     * @param float $id
     * @return array
     */
    public function open(float $parentId, float $id): array
    {
        return $this->changeStatus('open', $parentId, $id);
    }

    /**
     * @param float $parentId
     * @param float $id
     * @return array
     */
    public function cancel(float $parentId, float $id): array
    {
        return $this->changeStatus('cancel', $parentId, $id);
    }

    /**
     * @param string $status
     * @param float $parentId
     * @param float $id
     * @return array
     */
    private function changeStatus(string $status, float $parentId, float $id): array
    {
        $response = $this->request('POST', sprintf(
            '/admin/%s/%s/%s/%s/%s.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural,
            $id,
            $status
        ));

        return $response[$this->resourceChildKeySingular];
    }
}
