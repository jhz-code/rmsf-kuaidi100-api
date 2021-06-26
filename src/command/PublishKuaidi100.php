<?php


namespace RmTop\RmKuaidi100\command;


use RmTop\RmKuaidi100\lib\TopPublishFile;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Exception;

class PublishKuaidi100 extends Command
{


    protected function configure()
    {
        $this->setName('rmtop:publish_kuaidi_100')
            ->setDescription('发布快递100打印系统文件 ');
    }


    /**
     * 执行数据
     * @param Input $input
     * @param Output $output
     * @return int|void|null
     */
    protected function execute(Input $input, Output $output)
    {

        try{
            TopPublishFile::PublishFileToSys($output);//发布文件
            $output->writeln("all publish successfully！");
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
        }

    }

}