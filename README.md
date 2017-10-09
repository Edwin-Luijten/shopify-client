# Shopify API Client

[![Latest Version](https://img.shields.io/github/release/edwin-luijten/shopify-client.svg?style=flat)](https://github.com/Edwin-Luijten/shopify-client/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/Edwin-Luijten/shopify-client/develop.svg?style=flat-square)](https://travis-ci.org/Edwin-Luijten/shopify-client)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Edwin-Luijten/shopify-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/Edwin-Luijten/shopify-client/?branch=develop)
[![Quality Score](https://img.shields.io/scrutinizer/g/Edwin-Luijten/shopify-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/Edwin-Luijten/shopify-client/?branch=develop)
[![Total Downloads](https://img.shields.io/packagist/dt/edwin-luijten/shopify-client.svg?style=flat-square)](https://packagist.org/packages/edwin-luijten/shopify-client)

This package provides a client to communicate with the [Shopify](https://help.shopify.com/api/getting-started) api.

## Install

Via Composer

``` bash
$ composer require edwin-luijten/shopify-client
```

## Usage

### Creating a Shopify application

Read the following documentation: https://help.shopify.com/api/getting-started
### Using the Client
``` php
$client = new Client(new Config($domain, $key, $secret));
$client->orders->get(1);  
$client->orders->all();
$client->orders->all([
    'page' => 2,
]);
```

Throttle request to prevent bucket overflow:  

``` php
$totalProducts = $client->products->count();
$perPage = 50;
$pages = $totalProducts <= 50 ? 1: round($totalProducts / $perPage);
  
for($i = 0; $i <= $pages; $i++) {
    $products = $client->products->throttle(function($client, $i) {
        return $client->products->all([
            'page' => $i,
        ]);
    });
}
```

## Implemented resources

- [x] Abandoned checkouts  
- [x] Article  (Accessible trough blogs)
- [ ] Asset  
- [x] Blog  
- [x] CarrierService  
- [ ] Checkout  
- [ ] Collect  
- [ ] CollectionListing  
- [ ] Comment  
- [x] Country  
- [ ] CustomCollection  
- [x] Customer  
- [x] CustomerAddress (Accessible trough customers)
- [ ] CustomerSavedSearch  
- [x] DiscountCode  (Accessible trough priceRules)
- [ ] DraftOrder  
- [ ] Event  
- [x] Fulfillment  
- [ ] FulfillmentEvent  
- [x] FulfillmentService  
- [ ] Gift Card (Shopify Plus)  
- [ ] Location  
- [ ] Marketing Event  
- [ ] Metafield  
- [ ] Multipass (Shopify Plus)  
- [x] Order  
- [x] Order Risks  (Accessible trough orders)
- [x] Page
- [ ] Policy  
- [x] PriceRule  
- [x] Product  
- [x] Product Image (Accessible trough products)  
- [x] Product Variant  (Accessible trough products)
- [ ] ProductListing  
- [x] Province  (Accessible trough countries)
- [ ] RecurringApplicationCharge  
- [ ] Redirect  
- [ ] Refund  
- [ ] Report  
- [ ] ResourceFeedback  
- [ ] ScriptTag  
- [ ] Shipping Zone  
- [x] Shop  
- [ ] SmartCollection  
- [ ] Storefront Access Token  
- [ ] Theme  
- [ ] Transaction  
- [ ] UsageCharge  
- [ ] User (Shopify Plus)  
- [x] Webhook  
- [ ] ShopifyQL  



## Testing

Set some environment variables first:  
- SHOPIFY_DOMAIN  
- SHOPIFY_KEY  
- SHOPIFY_SECRET  
- SHOPIFY_RATE_LIMIT  
- SHOPIFY_PRODUCT_VARIANT_ID  

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Edwin Luijten](https://github.com/Edwin-Luijten)
- [All Contributors](https://github.com/Edwin-Luijten/shopify-client/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.