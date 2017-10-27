<?php

namespace ShopifyClient\Tests\Integration;

use PHPUnit\Framework\TestCase;
use ShopifyClient\Client;
use ShopifyClient\Config;

abstract class BaseTest extends TestCase
{
    /**
     * @var Client $client ;
     */
    public static $client;

    public static function setUpBeforeClass()
    {
        self::$client = new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET')
            )
        );
    }
}