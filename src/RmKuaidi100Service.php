<?php

namespace RmTop\RmKuaidi100;

use RmTop\RmKuaidi100\command\PublishKuaidi100;
use think\Service;

/**
 */
class RmKuaidi100Service extends Service
{
    /**
     * Register service.
     *
     * @return void
     */
    public function register()
    {
        // 注册数据迁移服务
        $this->app->register(\think\migration\Service::class);
    }

    /**
     * Boot function.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(['rmtop:publish_kuaidi_100' => PublishKuaidi100::class,]);
    }


}
