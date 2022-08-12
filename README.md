# nginx-log-analyzer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ritey/nginx-log-analyzer.svg?style=flat-square)](https://packagist.org/packages/ritey/nginx-log-analyzer)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/ritey/nginx-log-analyzer/master.svg?style=flat-square)](https://travis-ci.org/ritey/nginx-log-analyzer)
[![StyleCI](https://github.styleci.io/repos/216911317/shield?branch=master)](https://github.styleci.io/repos/216911317)
[![Coverage](https://img.shields.io/coveralls/github/ritey/nginx-log-analyzer?style=flat-square)](https://coveralls.io/github/ritey/nginx-log-analyzer)
[![Total Downloads](https://img.shields.io/packagist/dt/ritey/nginx-log-analyzer.svg?style=flat-square)](https://packagist.org/packages/ritey/nginx-log-analyzer)

---

## Installation

```bash
composer require ritey/nginx-log-analyzer
```

## Usage
```php
<?php

declare(strict_types=1);

use Ritey\NginxLogAnalyzer\Parse;
use Ritey\NginxLogAnalyzer\NginxAccessLogFormat;
use Ritey\NginxLogAnalyzer\RegexPattern;

$file = new SplFileObject('access.log');
$line = $file->fgets();

$parse = new Parse(new NginxAccessLogFormat(), new RegexPattern());
$information = $parse->line($line);
```

`var_dump($information):`

```
class stdClass#16 (8) {
  public $remote_addr =>
  string(13) "182.76.202.33"
  public $remote_user =>
  string(1) "-"
  public $time_local =>
  string(26) "21/Oct/2019:06:52:00 +0000"
  public $request =>
  string(14) "GET / HTTP/1.1"
  public $status =>
  string(3) "404"
  public $bytes_sent =>
  string(3) "580"
  public $http_referer =>
  string(1) "-"
  public $http_user_agent =>
  string(110) "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36"
}
```

## Configuration
Basically, `Parse` require two implementation:
1. `Format` contract. There is `getStringRepresentation() : string` method.
2. `Pattern` contract. There are `build(Format $format) : string` and `getIdentifiers() : array` methods.

Library already have built-in format support of default nginx access.log format which is:

`$remote_addr - $remote_user [$time_local] "$request" $status $bytes_sent "$http_referer" "$http_user_agent"`

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
