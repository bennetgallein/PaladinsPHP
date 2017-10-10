# discord-paladins

This a wrapper for the Paladins API by Hi-Rez studios.

## Getting Started

You can either copy the PHP file directly into your project or _preferable_ just use composer.

#### Composer require command
`composer require bennetgallein/paladins-php`

## Usage

It is fairly easy to use. I'll throw in an example.

```php
<?php
namespace Paladins;

use \Paladins\Paladins;

$devId = 'YOUR_DEV_ID';
$authKey = 'YOUR_DEV_AUTHKEY';
$format = Paladins::JSON; // see Documentation
$lang = Paladins::ENGLISH; // see Documentation

$paladins = new Paladins($devId, $authKey, $format, $lang);
$paladins->connect();
```

__NOTE__: Avoid creating a new Instance to often! The Session won't be valid after 15 Minutes, but the my API automatically creates a new one if you make any kind of request. So to avoid reaching the API's access limit (sessions per day of 500), do not make a new instance everytime you refresh!
## Documentation

Own Documentation will follow, for now here is the Link to the [official Hi-Rez API Documentation](https://docs.google.com/document/d/1OFS-3ocSx-1Rvg4afAnEHlT3917MAK_6eJTR6rzr-BM/edit);

### connect()

The Basic function to connect with the API-Endpoint. It takes 4 Parameters, not more, not less.
`$devId, $authKey, $format and $lang`, where `$format` is the response format of the API and `$lang` the language you want to use.

### constants

This library offers a few constants which are definitely good to use:

language codes:
```php
const ENGLISH = 1;
const GERMAN = 2;
const FRENCH = 3;
const SPANISH = 7;
const SPANISHLA = 9;
const PORTUGUESE = 10;
const RUSSIAN = 11;
const POLISH = 12;
const TURKISH = 13;
```
Access them with: `Paladins::<NAME>` for example: `Paladins::ENGLISH`;

response formats:
```php
const JSON = 'Json';
const XML = 'xml';
```
Access them with: `Paladins::<NAME>` for example: `Paladins::JSON`;

__NOTE__: This library does not support xml yet, maybe later in the future.

### getChampions()

This returns a assoc array with all the Champions.

### getChampion($name)

This returns an assoc array based of the Champions name provided in `$name`. For example

## License

The project is MIT licensed. To read the full license, open [LICENSE.md](LICENSE.md).

## Contributing

Pull requests and issues are open!
