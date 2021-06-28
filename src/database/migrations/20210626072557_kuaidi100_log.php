<?php

use Phinx\Db\Adapter\AdapterFactory;
use think\migration\Migrator;

class Kuaidi100Log extends Migrator
{
    /**
     * Initialize method.
     *
     * @return void
     */
    protected function init()
    {
        $options = $this->getDbConfig();

        $adapter = AdapterFactory::instance()->getAdapter($options['adapter'], $options);

        if ($adapter->hasOption('table_prefix') || $adapter->hasOption('table_suffix')) {
            $adapter = AdapterFactory::instance()->getWrapper('prefix', $adapter);
        }

        $this->setAdapter( $adapter);
    }

    /**
     * 获取数据库配置
     * @return array
     */
    protected function getDbConfig(): array
    {
        $default = config('database.default');

        $config = config("database.connections.{$default}");

        if (0 == $config['deploy']) {
            $dbConfig = [
                'adapter'      => $config['type'],
                'host'         => $config['hostname'],
                'name'         => $config['database'],
                'user'         => $config['username'],
                'pass'         => $config['password'],
                'port'         => $config['hostport'],
                'charset'      => $config['charset'],
                'table_prefix' => $config['prefix'],
            ];
        } else {
            $dbConfig = [
                'adapter'      => explode(',', $config['type'])[0],
                'host'         => explode(',', $config['hostname'])[0],
                'name'         => explode(',', $config['database'])[0],
                'user'         => explode(',', $config['username'])[0],
                'pass'         => explode(',', $config['password'])[0],
                'port'         => explode(',', $config['hostport'])[0],
                'charset'      => explode(',', $config['charset'])[0],
                'table_prefix' => explode(',', $config['prefix'])[0],
            ];
        }

        $table = config('database.migration_table', 'migrations');

        $dbConfig['default_migration_table'] = $dbConfig['table_prefix'] . $table;

        return $dbConfig;
    }

    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $table = $this->table("rm_kuaidi100_print_log");
        $table->addColumn('task_id', 'string', ['limit' =>100,'default'=>'0','comment'=>'打印任务ID'])
            ->addColumn('order_id', 'string', ['limit' => 100,'default'=>'','comment'=>'贵司内部自定义的订单编号,需要保证唯一性，非必填'])
            ->addColumn('salt', 'string', ['limit' => 80,'default'=>'','comment'=>'加密盐值'])
            ->addColumn('siid', 'string', ['limit' =>80,'default'=>'','comment'=>'打印机设备码'])
            ->addColumn('state', 'integer', ['limit' => 1,'default'=>1,'comment'=>'打印状态 1成功'])
            ->addColumn('create_time', 'string', ['limit' => 20,'default'=>'0','comment'=>''])
            ->addColumn('update_time', 'string', ['limit' => 20,'default'=>'0','comment'=>''])
            ->create();
    }


    public function down()
    {
        $table = $this->table("rm_kuaidi100_print_log");
        $table->drop();
    }
}
