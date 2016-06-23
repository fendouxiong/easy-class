<?php
/**
 * 处理字符串的方法集合
 * User: 奋斗熊
 * Date: 16/6/23
 * Time: 10:37
 */

class stringFactory
{

    /**
     * 格式化时间提示,刚刚,3分钟前,2小时前,昨天,前天
     *
     * @param $iTime int require 时间戳
     * @return bool|string
     */
    public static function sTime($iTime)
    {
        $sRtime = date("m-d H:i", $iTime);
        $sHtime = date("H:i", $iTime);
        $iTime  = time() - $iTime;
        if ($iTime < 60) {
            $sStr = '刚刚';
        } elseif ($iTime < 60 * 60) {
            $iMinutes = floor($iTime / 60);
            $sStr     = $iMinutes . '分钟前';
        } elseif ($iTime < 60 * 60 * 24) {
            $iHoure = floor($iTime / (60 * 60));
            $sStr   = $iHoure . '小时前 ' . $sHtime;
        } elseif ($iTime < 60 * 60 * 24 * 3) {
            $iDay = floor($iTime / (60 * 60 * 24));
            if ($iDay == 1) {
                $sStr = '昨天 ' . $sRtime;
            } else {
                $sStr = '前天 ' . $sRtime;
            }

        } else {
            $sStr = $sRtime;
        }
        return $sStr;
    }

    /**
     * 格式化时间提示,刚刚,3分钟前,2小时前,昨天,前天
     *
     * @param $iTime int require 时间戳
     * @return string
     */
    public static function formatTime($iTime)
    {
        $nowTime   = time();
        $sTimeDesc = '';
        $iDayTotal = 31;
        if (!empty($iTime)) {
            $iSubTime = $nowTime - $iTime;
            if ($iSubTime < 0) {
                $sTimeDesc = '1秒前';
            } else if ($iSubTime < 60) { //一分钟内
                $sTimeDesc = $iSubTime . '秒前';
            } else if ($iSubTime < 60 * 60) {
                $sTimeDesc = floor($iSubTime / 60) . '分钟前';
            } else if ($iSubTime < 60 * 60 * 24 * 1) {
                $sTimeDesc = floor($iSubTime / (60 * 60)) . '小时前';
            } else {
                for ($i = 1; $i <= $iDayTotal; $i++) {
                    if ($i < 31) {
                        if ($iSubTime < 60 * 60 * 24 * ($i + 1)) {
                            $iShowDay  = floor($iSubTime / (60 * 60 * 24));
                            $sTimeDesc = "{$iShowDay}天前";
                            break;
                        }
                    } else {
                        $sTimeDesc = "1个月前";
                        break;
                    }
                }
            }
        }
        return $sTimeDesc;
    }

}
