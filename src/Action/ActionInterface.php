<?php

namespace ShopifyClient\Action;

interface ActionInterface
{
    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return string
     */
    public function getEndpoint();

    /**
     * @return string|null
     */
    public function getResourceKey();

    /**
     * @return string|null
     */
    public function getResponseKey();
}