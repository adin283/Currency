# Currency

Alfred Workflow Currency Exchange. Convert any currency to CNY.

## API

The free API is from juhe.cn

Please apply from here:
[https://www.juhe.cn/docs/api/id/80](https://www.juhe.cn/docs/api/id/80)

Then fill in the appkey in ```CurrencyExchange.php```.

```php
<?php

class CurrencyExchange
{
    // Please fill in appkey here.
    private $_appKey = "appkey";
    private $_api = "http://op.juhe.cn/onebox/exchange/currency";
...
```

## Usage
```
usd 100
```

![usd](usd.jpg)

```
jpy 1000
```

![jpy](jpy.jpg)

Press enter than the result will copy to you clipboard.

## Customize

Here is the code in workflow editor.

```php
require_once('CurrencyExchange.php');

$currencyExchange = new CurrencyExchange();

$currencyExchange->caculate("USD", "CNY", {query});
```

You can convert any currency to another by modify the code of last line, like JPY to USD.

```
$currencyExchange->caculate("JPY", "USD", {query});
```