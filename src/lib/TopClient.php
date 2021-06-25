<?php


namespace RmTop\RmKuaidi100\lib;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Middleware;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class TopClient
{


    public string $apiUrl ;
    public string $action ;
    protected array $params;




    /**
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function Client(): array
    {
        $client = new Client();
        $clientHandler = $client->getConfig('handler');
        // Create a middleware that echoes parts of the request.
        $tapMiddleware = Middleware::tap(function ($request) {
        });
        $result = $client->request('POST', $this->apiUrl, [
            'http_errors' => false,
            'headers' => [ 'Accept' => 'application/x-www-form-urlencoded','User-Agent' => 'rmtop'],
            'handler' => $tapMiddleware($clientHandler),
            'json' => $this->params,
        ]);
        $res['StatusCode'] = $result->getStatusCode();
        $res['ReasonPhrase'] = $result->getReasonPhrase();
        $res['Content'] =json_decode($result->getBody(),true);
        return $res ;
    }





    /**
     * @param string $apiUrl
     */
    function setApiUrl(string $apiUrl){
        $this->apiUrl = $apiUrl;
    }


    /**
     * 设置参数
     * @param array $param
     */
    function setParams(array $param){
        $this->params = $param;
    }







}