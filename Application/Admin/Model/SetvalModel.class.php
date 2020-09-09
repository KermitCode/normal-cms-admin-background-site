<?php

/************************************
	*notes:具体各端各机型配置模型
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class SetvalModel extends BaseModel
{
	protected $tableName = 'setval';
    static $mName = 'setval';

    //取得当前平台，机型已经配置的各项值
	static function listSetval($platf)
	{
		$M     = M(self::$mName);
        $where = array('settgradeone' => $platf);
		$data = $M->field('settgradetwo, settype_id, setkey_id, setval')
                  ->where($where)
                  ->select();
        
        $return = array();
        foreach($data as $key => $row)
        {
            $return[$row['settgradetwo']][$row['settype_id']][$row['setkey_id']] = $row['setval'];
        }
		return $return; 
	}

    
}
