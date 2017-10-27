<?php

namespace ShopifyClient\Tests\Integration;

use ShopifyClient\Action\Action;

class ActionTest extends BaseTest {

    /**
     * @expectedException \ShopifyClient\Exception\ClientException
     */
    public function testInvalidMethod() {
        new Action('foo', 'bar');
    }
}