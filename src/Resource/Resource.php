<?php

namespace ShopifyClient\Resource;

interface Resource
{
    /**
     * @return array
     */
    public function getChildResources(): array;
}
