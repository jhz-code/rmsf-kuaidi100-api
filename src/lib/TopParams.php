<?php


namespace RmTop\RmKuaidi100\lib;


class TopParams
{

  static  function  getParams(array $params): array
  {
       return array_filter($params);
   }

}