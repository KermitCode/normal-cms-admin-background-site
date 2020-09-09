<?php

/************************************
	*notes:配置类型模型
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class SettypeModel extends BaseModel
{
	protected $tableName = 'settype';
    static $mName = 'settype';

    //类别列表
	static function pageList()
	{
		$M     = M(self::$mName);
		$count = $M->count();
		$Page  = new \Think\Page($count,10);
		$return['show'] = $Page->show();

		$return['list']  = $M->order('sortnum asc')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();
		return $return; 
	}

    
}