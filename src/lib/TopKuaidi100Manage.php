<?php


namespace RmTop\RmKuaidi100\lib;


use RmTop\RmKuaidi100\model\TopKuaidi100ConfigModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;


/**
 * Class TopKuaidi100Manage
 * @package RmTop\RmKuaidi100\lib
 * 打印机信息管理
 */

class TopKuaidi100Manage
{



    //---------------------------- 快递100配置------------------------------------
    /**
     * 创建配置
     *
     * @param $extra //筛选标识符
     * @param string $title
     * @param array $printer_info
     * @param array $config
     * @return TopKuaidi100ConfigModel|Model
     */
    static  function addConfig($extra, string $title, array  $printer_info,  array $config  )
    {
        return TopKuaidi100ConfigModel::create([
            'config_text' => serialize(array(
                'appKey'=>$config['appKey'],
                'appSecret'=>$config['appSecret'],
                'customer'=>$config['customer'],
                'userid'=>$config['userid'],
                'auto'=>$config['auto'],
                )),
            'extra'=>$extra,
            'title'=>$title,
            'printer_info'=>serialize($printer_info),
        ]);
    }

    /**
     * 更新配置
     * @param $id
     * @param string $title
     * @param string $extra
     * @param array $printer_info
     * @param array $config
     * @return TopKuaidi100ConfigModel
     */
    static function editConfig($id,
                               string $title,
                               string $extra,
                               array  $printer_info,array $config): TopKuaidi100ConfigModel
    {
        return TopKuaidi100ConfigModel::where(['id' => $id])->update([
            'config_text' => serialize(array(
                'appKey'=>$config['appKey'],
                'appSecret'=>$config['appSecret'],
                'customer'=>$config['customer'],
                'userid'=>$config['userid'],
                'auto'=>$config['auto'],
            )),
            'extra'=>$extra,
            'title'=>$title,
            'printer_info'=>serialize(array('siid'=>$printer_info['siid'])),
        ]);
    }


    /**
     * 更改打印机的某个参数
     * @param $id
     * @param string $type
     * @param $value
     * @return TopKuaidi100ConfigModel
     */
    static function configUpdate($id,string $type,$value){
        if($type == 'config'){
          return  TopKuaidi100ConfigModel::where(['id' => $id])->update([
                   'config_text' => serialize(array(
                    'appKey'=>$value['appKey'],
                    'appSecret'=>$value['appSecret'],
                    'customer'=>$value['customer'],
                    'userid'=>$value['customer'],
                    'auto'=>$value['auto'],
                )),
            ]);
        }else if($type == 'printer'){
            return  TopKuaidi100ConfigModel::where(['id' => $id])->update([
                'printer_info' => serialize(array(
                    'siid'=>$value['siid'],
                )),
            ]);
        }else if($type == 'other'){
            return  TopKuaidi100ConfigModel::where(['id' => $id])->update([
                'title' => $value['title'],
                'state' => $value['state'],
                'extra' => $value['extra'],
            ]);
        }else{
            return  TopKuaidi100ConfigModel::where(['id' => $id])->update([
                'isonline' => $value['isonline'],
            ]);
        }
    }


    /**
     * @param int $id
     * @return bool
     * 删除配置
     */
    static function deleteConfig(int $id): bool
    {
        return TopKuaidi100ConfigModel::where(['id' => $id])->delete();
    }


    /**
     * 输出配置
     * @param int $id
     * @return mixed
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    static function getConfig(int $id)
    {
        $result =  TopKuaidi100ConfigModel::where(['extra' => $id])->find();
        $result ['config'] = unserialize($result['config_text']);
        $result ['printer'] =  unserialize($result['printer_info']);
        return $result;
    }
    //------------------------------------------打印机管理--------------------------------------







}