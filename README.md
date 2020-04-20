# Eelly fastdfs

[![Latest Stable Version](https://poser.pugx.org/eelly/fastdfs/v/stable.png)](https://packagist.org/packages/eelly/fastdfs)
[![Total Downloads](https://poser.pugx.org/eelly/fastdfs/downloads.png)](https://packagist.org/packages/eelly/fastdfs)
[![StyleCI](https://styleci.io/repos/95066788/shield?branch=master)](https://styleci.io/repos/95066788)

## About Eelly fastdfs

Fastdfs php client.

## Install
Via Composer
```
composer require eelly/fastdfs
```

## Usage
```php
$config = [
             'host'  => '172.18.107.97',
             'port'  => 22122,
             'group' => [
                  'G01',
                  'G02',
              ],
          ];
$client = new \Eelly\FastDFS\Client($config);

// upload file
$filePath = $client->uploadFile('/path/file');

// delete file
$client->deleteFile($filePath);
```

## Testing
```
phpunit --bootstrap vendor/autoload.php tests/ClientTest.php

```

## Thanks
[fastdfs](https://github.com/happyfish100/fastdfs)