# AgileCRM Client for Laravel

[![AgileCRM Client for Laravel](https://github.com/isap-ou/laravel-agile-crm/blob/main/images/banner.jpg?raw=true)](https://github.com/isap-ou/laravel-agile-crm)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/isapp/laravel-agile-crm.svg?style=flat-square)](https://packagist.org/packages/isapp/laravel-agile-crm)
[![Total Downloads](https://img.shields.io/packagist/dt/isapp/laravel-agile-crm.svg?style=flat-square)](https://packagist.org/packages/isapp/laravel-agile-crm)

> **Please note!** 
> 
> We only include the endpoints necessary for the team's projects. If any endpoints are missing, feel free to create a pull request (PR) to add the required endpoints.

## Installation

You can install the package via composer:

```bash
composer require isapp/laravel-agile-crm
```

You will most likely need to edit the extensive configuration, so you can publish the config file with:

```bash
php artisan vendor:publish --tag="agile-crm"
```

## Usage

This package is based on documentation of [Agile CRM REST API](https://github.com/agilecrm/rest-api)

Each AgileCRM entity is implemented as a lightweight [DTO (Data Transfer Object)](https://wikipedia.org/wiki/DTO), providing straightforward access to the underlying data. 
This design minimizes the need for redundant validation processes and ensures that data handling remains simple and efficient without adding unnecessary complexity.

### Configuration

First You need to add environment variables [Authentication credentials](https://github.com/agilecrm/rest-api?tab=readme-ov-file#authentication-):

```dotenv
AGILE_CRM_DOMAIN=domain
AGILE_CRM_EMAIL=example@mail.com
AGILE_CRM_API_KEY=855*********************88
```

To work with multiple domains in parallel, simply add a new domain to the config/agile-crm.php file.

```php
return [
    ...

    'domains' => [
       ...
       'custom_domain' => [
           'domain' => env('AGILE_CRM_DOMAIN'),
           'email' => env('AGILE_CRM_EMAIL'),
           'api_key' => env('AGILE_CRM_API_KEY'),
       ],
    ],
];
```

## Examples: 

### Make request for default domain 
```php
$contact = AgileCrm::contacts()->index()
```

### Make request for NON default domain 
```php
$contact = AgileCrm::domain('custom_domain')->contacts()->index()
```

### Get contacts list
```php
$contact = AgileCrm::contacts()->index()
```
Result will [Collection](https://laravel.com/docs/11.x/collections) of [ContactDto](src/Dto/ContactDto.php)

### Create contact
```php
use Isapp\AgileCrm\Dto\ContactDto;
use Isapp\AgileCrm\Dto\ContactPropertyDto;
use Isapp\AgileCrm\Enums\ContactSystemPropertyName;
 
...
 
$properties = [];
$properties[] = new ContactPropertyDto(
    name: ContactSystemPropertyName::FIRST_NAME,
    value: 'John',
);
$properties[] = new ContactPropertyDto(
    name: ContactSystemPropertyName::LAST_NAME,
    value: 'Doe',
);
$properties[] = new ContactPropertyDto(
    name: ContactSystemPropertyName::EMAIL,
    value: 'mail@example.com',
);
$dto = new ContactDto(properties: $properties);

$contactDto = AgileCrm::contacts()->create($dto);

...
```
Result will [ContactDto](src/Dto/ContactDto.php)

## Contributing

Contributions are welcome! If you have suggestions for improvements, new features, or find any issues, feel free to
submit a pull request or open an [issue](https://github.com/isap-ou/laravel-agile-crm/issues) in this repository.

Thank you for helping make this package better for the community!

## License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

You are free to use, modify, and distribute it in your projects, as long as you comply with the terms of the license.

---

Maintained by [ISAPP](https://isapp.be) and [ISAP OÜ](https://isap.me).  
Check out our software development services at [isap.me](https://isap.me).