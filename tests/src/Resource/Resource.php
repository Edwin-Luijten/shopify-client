<?php

namespace ShopifyClient\Tests\Resource;

use PHPUnit\Framework\TestCase;
use ShopifyClient\Client;

abstract class Resource extends TestCase {
    /**
     * @var Client $client;
     */
    public static $client;

    public static function setUpBeforeClass()
    {
        self::$client = new Client(
            getenv('SHOPIFY_DOMAIN'),
            getenv('SHOPIFY_KEY'),
            getenv('SHOPIFY_SECRET')
        );
    }
}