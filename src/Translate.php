<?php

namespace Ishushx\LaravelTranslate;

use GuzzleHttp\Client;
use Ishushx\LaravelTranslate\Exceptions\HttpException;
use Overtrue\Pinyin\Pinyin;

class Translate
{
    protected $id;
    protected $key;
    protected $guzzleOptions = [];

    public function __construct(string $id, string $key)
    {
        $this->id = $id;
        $this->key = $key;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getPinyinClient()
    {
        return new Pinyin();
    }

    public function getTranslate($text)
    {
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';

        $salt = time();

        $sign = md5($this->id . $text . $salt . $this->key);

        $query = http_build_query([
            "q" => $text,
            "from" => "zh",
            "to" => "en",
            "appid" => $this->id,
            "salt" => $salt,
            "sign" => $sign,
        ]);

        try {
            $response = $this->getHttpClient()->get($api . $query);

            $result = json_decode($response->getBody(), true);

            if (isset($result['trans_result'][0]['dst'])) {
                return $result['trans_result'][0]['dst'];
            } else {
                // 如果百度翻译没有结果，使用拼音作为后备计划。
                return $this->pinyin($text);
            }

        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

    }

    private function pinyin($text)
    {
        return $this->getPinyinClient()->permalink($text);
    }

}