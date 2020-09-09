<?php

/************************************
	*notes:通用后台通用模型
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

#后台通用的系统功能部分调用都写此处
class AdminModel extends BaseModel
{
    static $mName = 'adminer';

    //管理员登录验证
    static function loginCheck($admin)
    {
        $condition = array('username' => $admin);
        return M(self::$mName, 'sys_')->where($condition)->find(); 
    }
    
    //管理员列表
	static function pageList()
	{
		$M     = M(self::$mName, 'sys_');
		$count = $M->count();
		$Page  = new \Think\Page($count,10);
		$return['show'] = $Page->show();

		$return['list']  = $M->order('id asc')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();
		return $return; 
	}

    //列出管理员列表
    static function listall()
    {
        $data = M(self::$mName, 'sys_')->order("id asc")->select();
        $r = array();
        foreach($data as $key=>$row)
        {
            $r[$row['id']] = $row['realname']."({$row['username']})";
        }
        return $r;
    }

    //取出后台配置数据
    static function getConfig()
    {
        $data = M('config', 'sys_')->select();
        return current($data);
    }

    //取出后台配置数据
    static function updateconfig($id, $data)
    {
        #echo '<pre>';print_r($id);print_r($data);exit;
        return M('config', 'sys_')->where("id={$id}")->save($data);
    }

    //取出菜单数组
    static function getMenuarr()
    {
        $menu = array();
        $data = self::getMenulist();
        foreach($data as $key=>$row)
        {
            if($row['fatherid'])
            {
                if(empty($menu[$data[$row['fatherid']]]['keychar']['child'])) 
                {
                    $menu[$data[$row['fatherid']]]['keychar']['child'] = array();
                }
                $menu[$data[$row['fatherid']]['keychar']]['child'][$row['keychar']]=array(
                    'name'=>$row['showname'],
                    'hidden'=>$row['hidden'],
                    'url'=>$row['fixurl']
                );
            }else{
                $menu[$row['keychar']]=array(
                    'name'=>$row['showname'],
                    'icon'=>$row['icon']
                );
            }
        }
        return $menu;
    }

    //取出菜单列表程序
    static function getMenulist()
    {
        $data = M('menu', 'sys_')->order('fatherid asc, sortnum asc')->select();
        $datas = $data;
        $menu = array();
        foreach($data as $row)
        {
            if(!$row['fatherid'])
            {
                $menu[$row['id']] = $row;
                foreach($data as $rows)
                {
                    if($rows['fatherid'] == $row['id']) $menu[$rows['id']] = $rows; 
                }
            }
        }
        return $menu;
    }

    //得到某一个菜单项
    static function getMenuByid($id)
    {
        return  M('menu', 'sys_')->where("id={$id}")->find();
    }

    //得到顶级菜单列表
    static function getFatherMenu()
    {
        $data = M('menu', 'sys_')->field('id,showname')->where("fatherid=0")->select();
        $menu = array(0=>'顶级菜单');
        foreach($data as $row) $menu[$row['id']] = $row['showname'];
        return $menu;
    }

    //updatemodel
    static function updatemenu($id, $data)
    {
        $data = M('menu', 'sys_')->where("id={$id}")->save($data);
        return $data;  
    }

    //addmenu
    static function addmenu($data)
    {
        return  M('menu', 'sys_')->add($data);
    }
}
