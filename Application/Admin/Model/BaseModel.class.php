<?php

/************************************
	*notes:模型基类
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class BaseModel extends Model
{
    //通用底层取单条数据
    static function getOne($id, $pre='')
    {
        return M(static::$mName, $pre)->find($id);
    }

    //查询全部
    static function getAll($pre='')
    {
        return M(static::$mName, $pre)->order('sortnum asc')->select();
    }
    
    //通用底层按条件取记录条数
    static function getNum($where, $pre='')
    {
        return M(static::$mName, $pre)->where($where)->count();
    }
    
    //通用通过主键修改
	static function update($id, $data, $pre='')
	{
        return M(static::$mName, $pre)->where("id={$id}")->setField($data);
	}
    
    //通用通过多属性修改
	static function updateByattr($where, $data)
	{
        return M(static::$mName)->where($where)->save($data); 
	}
    
    //允许覆盖数据
	static function updateByattrReplace($where, $data)
	{
        $merge = array_merge($where, $data);
        return M(static::$mName)->where($where)->add($merge, array(), true);
	}

    //允许覆盖数据
	static function insertOnDuplicateKeyUpdate($where, $data)
	{
        $where = safeCheck($where);
        $data = safeCheck($data);

        $table = C('DB_PREFIX').static::$mName;
        $merge = array_merge($where, $data);
        $set = $whe = array();
        foreach($data as $k=>$v) $set[] = "{$k}='{$v}'";
        foreach($where as $k=>$v) $whe[] = "{$k}='{$v}'";
 
        $sql = "INSERT INTO {$table}(".implode(',', array_keys($merge))
              .") VALUES ('".implode("','", array_values($merge))."') ON DUPLICATE KEY UPDATE "
              .implode(',',$set);
        $Model = new Model();
        return $Model->execute($sql);
	}
    
    //通用插入数据
    static function insert($data, $pre='')
    {
        return M(static::$mName, $pre)->add($data);
    }
    
    //通用只取某个值和ID的对应关系列表
    static function listField($field, $where = array())
    {
        $data = M(static::$mName)->field("id,{$field}")->where($where)->select();
        $return = array();
        if(!$data) return $return;
        foreach($data as $key=>$row)
        {
            $return[$row['id']] = $row[$field];
        }
        return $return;
    }
	
}
