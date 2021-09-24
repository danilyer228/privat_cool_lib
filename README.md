### Install
```
composer require danilyer228/privat_cool_lib
```
### Usage
```
use PrivatCoolLib\Exchange;

$exchange = new Exchange("USD", "UAH", 100);
// Вернет около 2727,12
var_dump($exchange->toDecimal())
```