<?php

/************************************
	*notes:配置项模型
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class SetkeyModel extends BaseModel
{
	protected $tableName = 'setkey';
    static $mName = 'setkey';

    //某平台的配置项分页列表
	static function pageList($platf)
	{
		$M     = M(self::$mName);
        $where = array('settgradeone' => $platf);
		$count = $M->where($where)->count();
		$Page  = new \Think\Page($count,10);
		$return['show'] = $Page->show();

		$return['list']  = $M->table('__SETKEY__  as a')
                             ->field('a.*,b.setname')
                             ->join("left join __SETTYPE__ as b on b.id = a.settype_id")
                             ->where($where)
                             ->order('b.sortnum asc, a.sortnum asc')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();
		return $return; 
	}
    
    //某平台的所有配置项列表
	static function allList($platf)
	{
		$M     = M(self::$mName);
        $where = array('settgradeone' => $platf, 'config_disable'=>1);
		$data = $M->table('__SETKEY__  as a')
                ->field('a.*,b.setname')
                ->join("left join __SETTYPE__ as b on b.id = a.settype_id")
                ->where($where)
                ->order('b.sortnum asc, a.sortnum asc')
                ->select();
        
        $return = array();
        foreach($data as $key => $row)
        {
            $return[$row['settype_id']][$row['id']] = $row;
        }
		return $return; 
	}
    
}
