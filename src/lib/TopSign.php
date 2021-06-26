<?php


namespace RmTop\RmKuaidi100\lib;


use think\model\concern\TimeStamp;

class TopSign
{


    /**
     * @param $params //加密参数
     * @param string $t //时间戳
     * @param string $appKey //key
     * @param string $appSecret //密匙
     * @return string
     */
   static function create_sign($params,string $t,string $appKey,string $appSecret): string
    {
        return strtoupper(md5(json_encode($params).$t.$appKey.$appSecret));
    }


    /**
     * 返回随机字符串
     * @return string
     */
    static function create_salt(): string
    {
        $stirs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        return substr(str_shuffle($stirs),mt_rand(0,strlen($stirs)-11),10);
    }

    /**
     * 回调签名
     * @param $param
     * @param $salt
     * @return string
     */
    static function acceptSign($param,$salt): string
    {
    return md5(json_encode($param).$salt);
   }



}