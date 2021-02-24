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

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->client = new Client();
    }

    /**
     * 获取access token
     *
     * @param string $code
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException|Exception
     */
    public function accessToken(string $code): array
    {
        $params = [
            'client_key'    => $this->config->clientKey,
            'client_secret' => $this->config->clientSecret,
            'code'          => $code,
            'grant_type'    => 'authorization_code'
        ];
        $url = Config::DOMAIN . '/oauth/access_token/?' . http_build_query($params);
        $response = $this->request('GET', $url);
        $content = $response->getBody()->getContents();

        return $this->decodeContent($content);
    }

    /**
     * 获取access token
     *
     * @param string $refreshToken
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException|Exception
     */
    public function refreshToken(string $refreshToken): array
    {
        $params = [
            'client_key'    => $this->config->clientKey,
            'refresh_token' => $refreshToken,
            'grant_type'    => 'refresh_token'
        ];
        $url = Config::DOMAIN . '/oauth/refresh_token/?' . http_build_query($params);
        $response = $this->request('GET', $url);
        $content = $response->getBody()->getContents();

        return $this->decodeContent($content);
    }

    /**
     * 获取用户信息
     *
     * @param string $openid
     * @param string $accessToken
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException|Exception
     */
    public function userinfo(string $openid, string $accessToken): array
    {
        $params = [
            'open_id'      => $openid,
            'access_token' => $accessToken
        ];
        $url = Config::DOMAIN . '/oauth/userinfo/?' . http_build_query($params);
        $response = $this->request('GET', $url);
        $content = $response->getBody()->getContents();

        return $this->decodeContent($content);
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
        return $this->client->request(strtoupper($method), $url, $options);
    }

    /**
     * 解析响应内容
     *
     * @param string $content
     * @return array
     * @throws Exception
     */
    protected function decodeContent(string $content): array
    {
        $contentArr = Json::decode($content);
        if (is_array($contentArr) === false) {
            throw new Exception(Config::NAME . '服务解析错误');
        }

        return $contentArr;
    }
}
