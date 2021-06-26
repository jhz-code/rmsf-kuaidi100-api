<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/25
 * Time: 1:00 上午
 */
namespace RmTop\RmKuaidi100\core;



use GuzzleHttp\Exception\GuzzleException;
use RmTop\RmKuaidi100\lib\TopKuaidi100Manage;
use RmTop\RmKuaidi100\lib\TopSign;
use RmTop\RmKuaidi100\lib\TopParams;
use RmTop\RmKuaidi100\lib\TopPrinter;
use RmTop\RmKuaidi100\model\TopKuaidi100ConfigModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

/**
 * Class TopKuaidi100
 * @package RmTop\RmKuaidi100\core
 * 打印操作模块
 */

class TopKuaidi100
{

    protected  $printer;

    public function __construct($configId)
    {
      $this->printer = TopKuaidi100Manage::getConfig($configId);
    }


    /**
     * @param $params
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function printOrder($params): array
    {
        $TopClient = new TopPrinter();
        list($msec, $sec) = explode(' ', microtime());
        $TIME = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);    //当前时间戳
        $TopClient->setParams([
            'method'=>"printOld",
            'key'=>$this->printer['config']['appKey'],
            't'=>$TIME,
            'param'=>TopParams::getParams($params),
            'sign'=>TopSign::create_sign(TopParams::getParams($params),$TIME,$this->printer['config']['appKey'],$this->printer['config']['appSecret']),
        ]);
        return  $TopClient->TopPrint();
    }

    /**
     * 二、附件打印接口
    为各应用产品提供的智能化打印解决方案。对接后可以让企业、个人实现PC/手机无线打印，远程打印，多人共享打印。打印内容包括但不限于文档、发票、发货单、快递单等，搭配云盒使用，支持激光、喷墨、针式、热敏打印机类型。让企业和个人打印更高效、更便捷。 通过接口上传打印内容，图片或PDF、Word等文件，即可打印该内容。
     * @param $params
     * @param $file
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function printImgOrder($params,$file): array
    {
        $TopClient = new TopPrinter();
        list($msec, $sec) = explode(' ', microtime());
        $TIME = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);    //当前时间戳
        $TopClient->setParams([
            'method'=>"imgOrder",
            'key'=>$this->printer['config']['appKey'],
            't'=>$TIME,
            'param'=>TopParams::getParams($params),
            'sign'=>TopSign::create_sign(TopParams::getParams($params),$TIME,$this->printer['config']['appKey'],$this->printer['config']['appSecret']),
            'file'=>$file
        ]);
        return  $TopClient->TopPrint();
    }



    /**自定义生成图片接口
       使用该接口可以自定义生成面单，发货单等的信息图片，并通过本地打印机打印。
     * @param $params
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function getPrintImg($params): array
    {
        $TopClient = new TopPrinter();
        list($msec, $sec) = explode(' ', microtime());
        $TIME = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);    //当前时间戳
        $TopClient->setParams([
            'method'=>"getPrintImg",
            'key'=>$this->printer['config']['appKey'],
            't'=>$TIME,
            'param'=>TopParams::getParams($params),
            'sign'=>TopSign::create_sign(TopParams::getParams($params),$TIME,$this->printer['config']['appKey'],$this->printer['config']['appSecret']),
        ]);
        return  $TopClient->TopPrint();
    }


    /**
     * 对短期内打印过的面单进行复打操作。 该接口支持在提交打印请求2天内的打印任务进行复打10次的操作。
     * @param $taskId
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function repeatPrintOld($taskId): array
    {
        $TopClient = new TopPrinter();
        list($msec, $sec) = explode(' ', microtime());
        $TIME = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);    //当前时间戳
        $TopClient->setParams([
            'method'=>"printOld",
            'key'=>$this->printer['config']['appKey'],
            't'=>$TIME,
            'param'=>TopParams::getParams(['taskId'=>$taskId]),
            'sign'=>TopSign::create_sign(TopParams::getParams(['taskId'=>$taskId]),$TIME,$this->printer['config']['appKey'],$this->printer['config']['appSecret']),
        ]);
        return  $TopClient->TopPrint();
    }


    /**
     * 获取打印机状态
     * @param string $siid
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function printerState(string $siid): array
    {
        $TopClient = new TopPrinter();
        list($msec, $sec) = explode(' ', microtime());
        $TIME = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);    //当前时间戳
        $TopClient->setParams([
            'method'=>"devstatus",
            'key'=>$this->printer['config']['appKey'],
            't'=>$TIME,
            'param'=>TopParams::getParams(['siid'=>$siid]),
            'sign'=>TopSign::create_sign(TopParams::getParams(['siid'=>$siid]),$TIME,$this->printer['config']['appKey'],$this->printer['config']['appSecret']),
        ]);
        return  $TopClient->TopPrint();
    }


    /**
     * 回调数据验证
     * @param $taskId
     * @param $sign
     * @param $param
     */
    function printCallBack($taskId,$sign,$param){

    }




}