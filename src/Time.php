<?php

namespace PHPToolbox;

/**
 * 时间相关
 */
class Time
{
    /**
     * 一分钟秒数
     */
    public const OneMinuteSeconds = 60;

    /**
     * 一小时秒数
     */
    public const OneHourSeconds = 3600;

    /**
     * 一天秒数
     */
    public const OneDaySeconds = 86400;

    /**
     * 获取毫秒时间戳 13位
     *
     * @return int
     */
    public static function getMillisecond(): int
    {
        return (int)(microtime(true) * 1000);
    }
}
