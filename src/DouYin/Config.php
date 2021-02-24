<?php

namespace PHPToolbox\DouYin;

class Config
{
    public $clientKey;
    public $clientSecret;

    public const NAME = '抖音';
    public const DOMAIN = 'https://open.douyin.com';


    public function __construct(string $clientKey, string $clientSecret)
    {
        $this->clientKey = $clientKey;
        $this->clientSecret = $clientSecret;
    }
}