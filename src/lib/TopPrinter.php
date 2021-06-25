<?php


namespace RmTop\RmKuaidi100\lib;



use GuzzleHttp\Exception\GuzzleException;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class TopPrinter
{

    protected string  $apiUrl = "https://poll.kuaidi100.com/printapi/printtask.do";
    protected array  $params;


    /**
     * 公用请求
     * @return array
     * @throws GuzzleException
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    function TopPrint(): array
    {
        $TopClient = new TopClient();
        $TopClient->setApiUrl($this->apiUrl);
        $TopClient->setParams($this->params);
        return $TopClient->Client();
    }




    function setParams(array $params){
         $this->params =$params;
    }

}