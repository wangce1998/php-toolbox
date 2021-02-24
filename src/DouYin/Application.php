<?php

namespace PHPToolbox\DouYin;

/**
 * 抖音 Application
 *
 * @package PHPToolbox\DouYin
 */
class Application
{
    /**
     * @var OAuth
     */
    public $oauth;

    public function __construct(Config $config)
    {
        $this->oauth = new OAuth($config);
    }
}
