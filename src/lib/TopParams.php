<?php


namespace RmTop\RmKuaidi100\lib;


class TopParams
{
    static  function  getParams(array $params)
    {
        return  json_encode($params, JSON_UNESCAPED_UNICODE);
    }


}