# Users (authenticatable)

[![Packagist PHP support](https://img.shields.io/packagist/php-v/sfneal/users)](https://packagist.org/packages/sfneal/users)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/users.svg?style=flat-square)](https://packagist.org/packages/sfneal/users)
[![Build Status](https://travis-ci.com/sfneal/users.svg?branch=master&style=flat-square)](https://travis-ci.com/sfneal/users)
[![Quality Score](https://img.shields.io/scrutinizer/g/sfneal/users.svg?style=flat-square)](https://scrutinizer-ci.com/g/sfneal/users)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/users.svg?style=flat-square)](https://packagist.org/packages/sfneal/users)

Extended use of the default App\User Eloquent model used by Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require sfneal/users
```

In order to autoload to the auth helper functions add the following path to the autoload.files section in your composer.json.

```json
"autoload": {
    "files": [
        "vendor/sfneal/users/src/helpers/auth.php"
    ]
},
```

To modify the user config file (like adding organization constants) publish the ServiceProvider with the following command.

``` php
php artisan vendor:publish --provider="Sfneal\Users\Providers\UsersServiceProvider"
```

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
