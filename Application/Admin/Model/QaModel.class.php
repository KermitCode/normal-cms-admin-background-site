<?php

/************************************
    *notes:操作记录模型
    *Author:04007.cn
    *Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class QaModel extends BaseModel
{
    protected $tableName = 'qa';
    static $mName = 'qa';

    //问题分类
    public static $cateMaps = array(
        1 => '后台使用问题',
        2 => '前台业务问题',
    );

    static function getPageList($where=1)
    {
        $M = M('qa', 'sys_');
        /*
        if(isset($where['searchkey'])){
            $where['dowhat'] = array('like',"%{$where['searchkey']}%");
            unset($where['searchkey']);
        }
        */
        $count = $M->where($where)->count();
        $Page  = new \Think\Page($count,10);
        $return['show'] = $Page->show();

        $list  = $M->where($where)
                             ->order('id desc')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();
        $return['list'] = self::formateRows($list);
        return $return; 
    }

    static function formateRows($list) {
        foreach ($list as $key => $value) {
            $value['catename'] = self::$cateMaps[$value['cateid']];
            $list[$key] = $value;
        }
        return $list;
    }

}
