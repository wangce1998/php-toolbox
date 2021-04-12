<?php

namespace PHPToolbox;

/**
 * AES加密解密
 *
 * @package PHPToolbox
 */
class AES
{
    protected $key;
    protected $iv;
    protected $cipherAlgo;

    public function __construct(string $key, string $iv, string $cipherAlgo = 'AES-256-CBC')
    {
        $this->key = $key;
        $this->iv = $iv;
        $this->cipherAlgo = $cipherAlgo;
    }

    public function decrypt($data)
    {
        return openssl_decrypt(base64_decode($data), $this->cipherAlgo, $this->key, OPENSSL_RAW_DATA, $this->iv);
    }

    public function encrypt($data): string
    {
        return base64_encode(openssl_encrypt($data, $this->cipherAlgo, $this->key, OPENSSL_RAW_DATA, $this->iv));
    }
}
