
# IBAN Library for PHP

[![Latest release on Packagist][ico-release]][link-packagist]
[![Latest prerelease on Packagist][ico-prerelease]][link-packagist]
[![Software License][ico-license]][link-license]
[![Total Downloads][ico-downloads]][link-downloads]
[![Hits][ico-hits]][link-hits]


## Description
This is a simple class to calculate the iban of a given account number, bank sort code and country code.

## Table of Contents
- [Basic usage example](#basic-usage-example)
- [Support](#support)
- [Features & pull requests](#features--pull-requests)
- [Security](#security)
- [Credits](#credits)
- [License](#license)


## Basic usage example
This is a basic example, which will echo out a calculated iban:

```php
use Webklex\IBAN\IBAN;

require_once "vendor/autoload.php";

$account_number = "123456789";
$bank_sort_code = "10000000";
$country_code = "de";

$iban = IBAN::make($account_number, $bank_sort_code, $country_code);

echo $iban->calculate();
```

## Support
If you encounter any problems or if you find a bug, please don't hesitate to create a new [issue](https://github.com/Webklex/iban/issues).
However, please be aware that it might take some time to get an answer.
Off-topic, rude or abusive issues will be deleted without any notice.

If you need **commercial** support, feel free to send me a mail at github@webklex.com.


## Change log
Please see [CHANGELOG][link-changelog] for more information what has changed recently.


## Security
If you discover any security related issues, please email github@webklex.com instead of using the issue tracker.


## Credits
- [Webklex][link-author]
- [All Contributors][link-contributors]


## License
The MIT License (MIT). Please see [License File][link-license] for more information.


[ico-release]: https://img.shields.io/packagist/v/Webklex/iban.svg?style=flat-square&label=version
[ico-prerelease]: https://img.shields.io/github/v/release/webklex/iban?include_prereleases&style=flat-square&label=pre-release
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Webklex/iban.svg?style=flat-square
[ico-hits]: https://hits.webklex.com/svg/webklex/iban

[link-packagist]: https://packagist.org/packages/Webklex/iban
[link-downloads]: https://packagist.org/packages/Webklex/iban
[link-author]: https://github.com/webklex
[link-contributors]: https://github.com/Webklex/iban/graphs/contributors
[link-license]: https://github.com/Webklex/iban/blob/master/LICENSE
[link-changelog]: https://github.com/Webklex/iban/blob/master/CHANGELOG.md
[link-hits]: https://hits.webklex.com
