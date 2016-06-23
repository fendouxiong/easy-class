<?php
/**
 * Created by PhpStorm.
 * User: wuxiaofei
 * Date: 16/6/23
 * Time: 10:58
 */

class checkFactory
{

    /**
     * 判断数据类型是否正确
     *
     * @param $mData mix require 需要验证的数据
     * @param $sDataType string require 需要验证的类型
     * @return true/false
     */
    public function chkDataType($mData, $sDataType)
    {
        if ('' == $mData) {
            return false;
        }
        switch ($sDataType) {
            case 'i':
                return 0 < preg_match('/^-?[1-9]?[0-9]*$/', $mData) ? true : false;
            case 'url':
                return 0 < preg_match('/^https?:\/\/([a-z0-9-]+\.)+[a-z0-9]{2,4}.*$/', $mData) ? true : false;
            case 'email':
                return 0 < preg_match('/^[a-z0-9_+.-]+\@([a-z0-9-]+\.)+[a-z0-9]{2,4}$/i', $mData) ? true : false;
            case 'idcard':
                return 0 < preg_match('/^[0-9]{15}$|^[0-9]{17}[a-zA-Z0-9]/', $mData) ? true : false;
            case 'area':
                return 0 < preg_match('/^\d+(\.\d{1,2})?$/', $mData) ? true : false;
            case 'money':
                return 0 < preg_match('/^\d+(\.\d{1,2})?$/', $mData) ? true : false;
            case 'length':
                return 0 < preg_match('/^\d+(\.\d{1,2})?$/', $mData) ? true : false;
            case 'mobile':
                return 0 < preg_match("/^((1[3-9][0-9])|200)[0-9]{8}$/", $mData) ? true : false;
            //return 0 < preg_match("/^((13[0-9])|(17[0-9])|145|147|(15[0-35-9])|(18[0-9])|200)[0-9]{8}$/", $mData) ? true : false;
            //return 0 < preg_match('/^1\d{10,10}$/', $mData) ? true : false;
            case 'phone':
                return 0 < preg_match('/^(\d{3,4}-?)?\d{7,8}$/', $mData) ? true : false;
            case 'chinese':
                return 0 < preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $mData) ? true : false;
            default:
                return false;
        }
    }
}
