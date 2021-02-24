<?php

namespace PHPToolbox\DouYin;

use Exception;
use GuzzleHttp\Client;
use PHPToolbox\Json;
use Psr\Http\Message\ResponseInterface;

class OAuth
{
    /**
     * @var Config
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 获取access token
     *
     * @param string $code
     * @return array
     * @throws Exception
     */
    public function accessToken(string $code): array
    {
        $params = [
            'client_key'    => $this->config->clientKey,
            'client_secret' => $this->config->clientSecret,
            'code'          => $code,
            'grant_type'    => 'authorization_code'
        ];
        $url = Config::DOMAIN . '/oauth/access_token?' . http_build_query($params);
        $response = $this->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArr = Json::decode($content);
        if (is_array($contentArr) === false) {
            throw new Exception(Config::NAME . '服务解析错误');
        }

        return $contentArr;
    }

    /**
     * 发起http请求
     *
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $client = new Client();

        return $client->request(strtoupper($method), $url, $options);
    }
}
