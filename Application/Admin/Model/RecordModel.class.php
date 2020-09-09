<?php

/************************************
	*notes:操作记录模型
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class RecordModel extends BaseModel
{
	protected $tableName = 'record';

	static function pageList($where=1)
	{
		$M     = M('record', 'sys_');
        if(isset($where['searchkey'])){
            $where['dowhat'] = array('like',"%{$where['searchkey']}%");
            unset($where['searchkey']);
        }
        
		$count = $M->where($where)->count();
		$Page  = new \Think\Page($count,10);
		$return['show'] = $Page->show();

		$return['list']  = $M->where($where)
                             ->order('id desc')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();
		return $return; 
	}

}
