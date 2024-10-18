# AgileCRM Client for Laravel

## Installation

You can install the package via composer:

```bash
composer require isap-ou/laravel-agile-crm
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
AGILE_CRM_DOMAIN=isap
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
use IsapOu\AgileCrm\Dto\ContactDto;
use IsapOu\AgileCrm\Dto\ContactPropertyDto;
use IsapOu\AgileCrm\Enums\ContactSystemPropertyName;
 
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

Please, submit bugs or feature requests via the [Github issues](https://github.com/isap-ou/laravel-agile-crm/issues).
Pull requests are welcomed! Thanks!

## License

The AgileCRM Client for Laravel is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
