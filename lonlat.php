<?php
/**
 * Created by PhpStorm.
 * User: wuxiaofei
 * Date: 2018/1/17
 * Time: 下午4:04
 */

class lonlat
{
    /**
     * 百度经纬度转腾讯经纬度
     * @param $lon 经度
     * @param $lat 纬度
     * @param int $p 保留位数
     * @return array
     */
    public function baiduToTencent($lon, $lat, $p = 15)
    {
        $x = (double)$lat - 0.0065;
        $y = (double)$lon - 0.006;
        $x_pi = 3.14159265358979324;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $b = number_format($z * cos($theta), $p);
        $a = number_format($z * sin($theta), $p);
        return [$a,$b];
    }

    /**
     * 腾讯经纬度转百度经纬度
     * @param $lon 经度
     * @param $lat 纬度
     * @param int $p 保留位数
     * @return array
     */
    public function tencentToBaidu($lon, $lat, $p = 15){
        $x = (double)$lat;
        $y = (double)$lon;
        $x_pi = 3.14159265358979324;
        $z = sqrt($x * $x + $y * $y) + 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) + 0.000003 * cos($x * $x_pi);
        $b = number_format($z * cos($theta) + 0.0065, $p);
        $a = number_format($z * sin($theta) + 0.006, $p);
        return [$a,$b];
    }

}