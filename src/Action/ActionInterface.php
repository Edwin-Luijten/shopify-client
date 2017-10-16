<?php

namespace ShopifyClient\Action;

interface ActionInterface
{
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * @return string|null
     */
    public function getResourceKey();

    /**
     * @return string|null
     */
    public function getResponseKey();
}