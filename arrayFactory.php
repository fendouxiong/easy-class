<?php
/**
 * 处理数组的方法集合
 * User: 奋斗熊
 * Date: 16/6/23
 * Time: 10:14
 */

class arrayFactory{


    /**
     * 根据指定的分隔符,将字符串分割为数组
     *
     * @param $sParam string require 要分割的字符串
     * @param  $sStr string  option 指定字符
     * @return array
     */
    public function string2Array($sParam, $sStr = ',')
    {
        if(!is_string($sParam)){
            return [];
        }
        if(is_array($sParam)){
            return $sParam;
        }
        if(false === stripos($sParam, $sStr)){
            return [$sParam];
        }
        $aStoA = array_filter(str_getcsv($sParam));
        return $aStoA;
    }

    /**
     * 取二维数组的子数组的一个元素作为键名。
     *
     * @param array $aArray require 传入的二维数组
     * @param string $sFiled require 需要作为key的字段
     * @return array
     */
    static public function useFieldAsKey($aArray, $sFiled) {
        if(!is_array($aArray) || !count($aArray) || !is_array(current($aArray))) {
            return $aArray;
        }
        $aResult = array();
        foreach($aArray as $v) {
            $aResult[$v[$sFiled]] = $v;
        }
        return $aResult;
    }

    /**
     * 取二维数组的子数组的指定字段集合。
     *
     * @param array $aArray require 传入的二维数组
     * @param string $sFiled require 要取的字段
     * @return array
     */
    static public function getFieldValues($aArray, $sFiled) {
        if(!is_array($aArray) || !count($aArray) || !is_array(current($aArray))) {
            return [];
        }
        $aResult = array();
        foreach($aArray as $v) {
            if(isset($v[$sFiled])) {
                $aResult[] = $v[$sFiled];
            }
        }
        return is_array(array_get($aResult, 0, null)) ? $aResult : array_unique($aResult);
    }

    /**
     * 将数组的驼峰式key转换为snack式
     *
     * @param array $aData require 需要操作的数组
     * @return array
     */
    public static function snakeArrayKeys($aData)
    {
        if(!is_array($aData) || !count($aData)) {
            return $aData;
        }

        $aRe = array();

        foreach($aData as $k => $v) {
            if(!is_numeric($k)) {
                $k = snake_case(substr(str_replace(['iAutoID', 'ID', 'NO'], ['iId', 'Id', 'No'], $k), 1));
            }
            if(is_array($v)) {
                $aRe[$k] = array();
                foreach($v as $kk => $vv) {
                    if(!is_numeric($kk)) {
                        $kk = snake_case(substr(str_replace(['iAutoID', 'ID', 'NO'], ['iId', 'Id', 'No'], $kk), 1));
                        if(preg_match('/_time$/', $kk) && is_numeric($vv)) {
                            $vv = date('Y-m-d H:i', $vv);
                        }
                        $aRe[$k][$kk] = $vv;
                    } else {
                        $aRe[$k][$kk] = $vv;
                    }
                }
            } else {
                if(preg_match('/_time$/', $k) && is_numeric($v)) {
                    $v = date('Y-m-d H:i', $v);
                }
                $aRe[$k] = $v;
            }
        }
        return $aRe;
    }


}
