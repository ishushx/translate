<h1 align="center"> laravel-translate </h1>

<p align="center"> 基于百度翻译的 laravel 翻译组件.</p>


## 安装

```shell
$ composer require ishushx/laravel-translate -vvv
```

## 配置

在使用本扩展之前，你需要去 [百度翻译平台](http://api.fanyi.baidu.com/api/trans/product/index) 注册账号，然后创建应用，获取应用的 `API Id` 和 `API Key`。

## 使用
```php
use Ishushx\LaravelTranslate\Translate;

$appid='xxxxxxxxxxxxxxxxxxxxxxxxxxx';
$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$translate = new Translate($appid,$key);
```

## 获取翻译结果
```php
$text='xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$response = $translate->getTranslate($text);
```
## 在 Laravel 中使用
在 `Laravel` 中使用也是同样的安装方式，配置写在 `config/services.php` 中：
```php
'baidu_translate' => [
        'appid' => env('BAIDU_TRANSLATE_APPID'),
        'key'   => env('BAIDU_TRANSLATE_KEY'),
    ],
```
然后在 .env 中配置 `BAIDU_TRANSLATE_APPID` 和 `BAIDU_TRANSLATE_KEY` ：
```php
BAIDU_TRANSLATE_APPID=
BAIDU_TRANSLATE_KEY=
```
可以用两种方式来获取 `Ishushx\LaravelTranslate\Translate` 实例：

方法参数注入
```php
    
    public function translate(Translate $translate) 
    {
        $response = $translate->getTranslate('翻译文本');
    }
   
```    
服务名访问
```php
   
    public function translate() 
    {
        $response = app('translate')->getTranslate('翻译文本');
    }
   
```
   
## License

MIT
