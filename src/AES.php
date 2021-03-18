<?php

namespace PHPToolbox;

/**
 * AES加密解密
 *
 * @package PHPToolbox
 */
class AES
{
    private $key;
    private $iv;

    public function __construct(string $key, string $iv)
    {
        $this->key = $key;
        $this->iv = $iv;
    }

    public function decrypt($data)
    {
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->iv);
    }

    private function encrypt($data): string
    {
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->iv));
    }
}
