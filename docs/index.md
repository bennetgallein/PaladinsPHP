# PaladinsPHP [![Build Status](https://travis-ci.org/bennetgallein/PaladinsPHP.svg?branch=master)](https://travis-ci.org/bennetgallein/PaladinsPHP)

This a wrapper for the Paladins API by Hi-Rez studios.
You can find the PHP Documentation here: [https://bennetgallein.github.io/PaladinsPHP](https://bennetgallein.github.io/PaladinsPHP)
___
## Getting Started

You can either copy the PHP file directly into your project or _preferable_ just use composer.
___
#### Composer require command
`composer require bennetgallein/paladins-php`
___
### Notice:
I am not familiar with the Game "Smite", so there may be endpoints from Smite in this API. If there are, please open a issue or a pull request. Also the Documentation from HiRez is not very sexy, so please excuse misstakes.
___
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

$paladins = new Paladins($devId, $authKey, $format, $lang, "localhost, "root_user", "root_password", "database_name");

$paladins->connect();
```
__NOTE__: The API automatically renews the session with help of a MySQL Database. Therefore you need the MySQL Parameters. Default Parameters for host, user, password and database are the following: "localhost, root, root and PaladinsAPI".
___
## Documentation

Own Documentation will follow, for now here is the Link to the [official Hi-Rez API Documentation](https://docs.google.com/document/d/1OFS-3ocSx-1Rvg4afAnEHlT3917MAK_6eJTR6rzr-BM/edit);
PHP Documentation can be found [here](https://bennetgallein.github.io/PaladinsPHP)
***

#### connect()

The Basic function to connect with the API-Endpoint. It takes 4 Parameters, not more, not less.
`$devId, $authKey, $format, $lang, $host, $user, $password, $database`, where `$format` is the response format of the API and `$lang` the language you want to use.
The `$host`, `$user`, `$password` and `$database` are MySQL Parameters. Be sure to have a Database setup. Table creation does the API itselfs.
___
#### constants

This library offers a few constants which are definitely good to use:

language codes:
```php
const ENGLISH = 1;
const GERMAN = 2;
const FRENCH = 3;
const SPANISH = 7;
const SPANISHLA = 9; // Spanish (Latin America)
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