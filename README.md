![Feltkamp.tv](http://www.feltkamp.tv/images/logo.png)

# RRPproxy API

PHP Class for the RRPproxy API

## Requirements

- PHP 5.2 or higher
- CURL
- RRPproxy API credentials

## Get started

You will find everything you need to know to use this API in the [API Documentation](https://wiki.rrpproxy.net/API:Contents)

## Usage

```php
include('rrpproxy.class.php');
$rrp = new RRPProxy($username, $password);
$domain_check = $rrp->CheckDomain($domain);
```

### What is RRPproxy?

RRPproxy offers domain name registration and webhosting services for resellers. 

## License

This code is licensed under the GNU license.
