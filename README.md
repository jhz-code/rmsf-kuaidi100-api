# rmsf-kuaidi100-api
快递100云打印 

安装插件:
~~~
composer require rmtop/rmsf-kuaidi100-api
~~~


创建配置文件以及数据库模型:
~~~
//发布文件
php think  rmtop:publish_kuaidi_100  

//执行数据迁移
php think migrate:run  

~~~


### 打印机配置：

~~~
     //添加打印
     * @param $extra //筛选标识符 打印机归属 自定义用户ID
     * @param string $title //打印机名称
     * @param array $printer_info  //打印机详细信息 
     * @param array $config  //快递100 接口密钥配置信息
     * @return TopKuaidi100ConfigModel|Model
     
    TopKuaidi100Manage::addConfig('customerId','测试打印机',['siid'=>'KX100L2XXX'],[
           'appKey'=>'XXX',
           'appSecret'=>'208b1e9f13XXXXXXXX',
           'customer'=>'4509808DDDXXXXXXXXX',
           'userid'=>'8b8b2edb8XXXXXXX',
           'auto'=>'BlXXXXXXXX',
      ]);
    
     /**
     *打印机配置信息修改
     * 更新配置
     * @param $id
     * @param string $title  //打印机名称
     * @param string $extra //筛选标识符 打印机归属 自定义用户ID
     * @param array $printer_info //打印机详细信息 
     * @param array $config //快递100 接口密钥配置信息
     * @return TopKuaidi100ConfigModel
     */ 
    TopKuaidi100Manage::editConfig($id,string $title, string $extra,  array  $printer_info,array $config)
    
    //删除配置信息
    TopKuaidi100Manage::deleteConfig($id)
    
    //** 获取某个标识下的打印机列表  返回数组
    TopKuaidi100Manage::getPrinterList(string $extra)
    
   //** 获取单台打印机信息以及配置
       TopKuaidi100Manage::getConfig(int $id)
     
~~~


### 打印面单例子:

~~~

     //获取打印机的配置ID时，先根据用户标识符获取旗下的打印机列表，
     
     然后根据打印机的configId来获取打印机详情，进行打印


    function test(){
       
       $arr =  TopKuaidi100Manage::getPrinterList(string $extra)
    
        $client = new TopKuaidi100($arr[0][id]);
        $param = array (
            'type' => '10',                    //业务类型，默认为10
            'partnerId' => 'K5xxxxx',                 //电子面单客户账户或月结账号
            'partnerKey' => 'O9xxxx',                //电子面单密码
            'net' => 'xx',                       //收件网点名称,由快递公司当地网点分配
            'kuaidicom' => 'yuantong',                 //快递公司的编码
            'recMan' => array (
                'name' => '张三',                  //收件人姓名
                'mobile' => '1828826xxx',                //收件人手机
                'printAddr' => '云南昆明五华区金鼎科技园18号B座',             //收件人地址
                'company' => 'rmsf'                //收件人公司名
            ),
            'sendMan' => array (
                'name' => '李四',                  //寄件人姓名
                'mobile' => '1828826xxxx',                //寄件人手机
                'printAddr' => '云南昆明五华区金鼎科技园18号B座',             //寄件人地址
                'company' => '云南昆明'                //寄件人公司名
            ),
            'cargo' => '汽车坐垫',                     //物品名称
            'count' => '1',                     //物品总数量
            'weight' => '1',                    //物品总重量
            'payType' => 'SHIPPER',            //支付方式
            'expType' => '标准快递',           //快递类型: 标准快递（默认）、顺丰特惠、EMS经济
            'remark' => '请',                    //备注
            'tempid' => '47a63e455d5142e9a54xxx',                    //电子面单模板编码
            'siid' => 'KX100L210xxxx'                       //设备编码
        );
        var_dump($client->eOrder($param));

    }

~~~


### 获取打印机状态例子:

~~~
  
function printerState(){
        $client = new TopKuaidi100(1);
        var_dump($client->printerState());
}

~~~



### 快递100 参数说明
https://api.kuaidi100.com/document/5f0ff6adbc8da837cbd8aef8.html