# Filament Template

[![Latest Version on Packagist](https://img.shields.io/packagist/v/latvel/filament-template.svg?style=flat-square)](https://packagist.org/packages/latvel/filament-template)
[![Total Downloads](https://img.shields.io/packagist/dt/latvel/filament-template.svg?style=flat-square)](https://packagist.org/packages/latvel/filament-template)

## Installation

You can install the package via composer:

```bash
composer require latvel/filament-template
```

## Create template

```php
php artisan make:filament-template CustomTemplate
```

## Usage

```php
use Latvel\FilamentTemplate\Forms\Components\Template;

Template::make('content')
    ->template($templateClass)
```

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.