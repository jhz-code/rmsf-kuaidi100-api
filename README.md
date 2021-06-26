# rmsf-kuaidi100-api
快递100云打印 



### 打印面单例子:

~~~

    function test(){
        $client = new TopKuaidi100(1);
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