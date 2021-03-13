<?php

namespace PHPToolbox;

/**
 * 数学算法相关
 *
 * @package PHPToolbox
 */
class Math
{
    /**
     * 是否是等差数列
     *
     * @param array $numbers 一组数
     * @param int $d 公差
     * @return bool
     */
    public static function isArithmeticSequence(array $numbers, int $d): bool
    {
        if ($numbers === []) {
            return false;
        }
        sort($numbers);

        $first = $numbers[0];
        $count = count($numbers);
        foreach ($numbers as $n => $number) {
            // an=a1+(n-1)*d
            $next = $first + ($n + 2 - 1) * $d;
            if ($n < $count - 1 && $numbers[$n + 1] !== $next) {
                return false;
            }
        }

        return true;
    }

    /**
     * 查找数组内连续的数
     *
     * @param array $numbers 一组数
     * @param int $d 公差
     * @return array 返回多个连续数
     */
    public static function findContinuous(array $numbers, int $d): array
    {
        $data = [];
        $count = count($numbers);
        if ($count < 2) {
            return $data;
        }

        foreach ($numbers as $value) {

            // array为空说明已经找到最后一个元素了
            if ($numbers === []) {
                break;
            }

            $row = self::findContinuousChild($numbers, $d);
            if ($row !== []) {
                // 找出已经查找过的数最后一位索引，这个索引前的数都从array中剔除掉
                $index = array_search($row[count($row) - 1], $row);
                $numbers = array_slice($numbers, $index);
                $data[] = $row;
            } else {
                // 去掉本次查找的数
                array_shift($numbers);
            }
        }

        return $data;
    }

    private static function findContinuousChild(array $numbers, int $d): array
    {
        $count = count($numbers);
        $row = [];
        $start = $numbers[0];
        foreach ($numbers as $key => $number) {
            $next = $start + $d * ($key + 1);
            if ($key + 1 < $count && $numbers[$key + 1] === $next) {
                $row[] = $next;
            } else {
                break;
            }
        }

        // 如果找到连续数把自己也放进去
        if ($row !== []) {
            array_unshift($row, $start);
        }

        return $row;
    }
}