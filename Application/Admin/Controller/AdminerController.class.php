<?php

/************************************
	*notes:通用后台管理员控制器
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;

class AdminerController extends BaseController
{
    //管理员列表
    public function index()
    {
        $pageData = AdminModel::pageList();
        $this->assign('pageData', $pageData);
        $this->display();
    }

    //修改管理员资料
    public function modify($id=0)
    {
        //如果是POST提交表单
        if(isset($_POST['realname']))
        {
            $data = I();
            $data['status'] == 1 || $data['status'] = 0;
            $data['realname'] = trim($data['realname']);
            $data['username'] = trim($data['username']);
            $pass = trim($data['pass']);
            $id = isset($data['id'])?intval($data['id']):0;
            unset($data['id'], $data['right']);
            if(!$data['username'] || !$data['realname'])
            {
                $this->showError('真实姓名和账号不能为空!');
            }
            
            $data['phone'] = trim(trim($data['phone']), ',');
            if($data['phone'] && (!is_numeric($data['phone']) || strlen($data['phone']) != 11))
            {
                $this->showError('手机号无效!');
            }
            
            //修改管理员
            if($id)
            {                
                //修改管理员时的密码处理:不为空则更新密码
                if(!empty($pass)) $data['password'] = md5($pass);
            
                //查找管理员判断基本权限
                $adminer = AdminModel::getOne($id, 'sys_');
                if(!$adminer || ($adminer['id']==1 && $this->userId != 1) )
                {
                    return $this->showError('非法操作!');
                }
                
                //如果账户名称发生改变，需要判断新名称是否存在
                if($adminer['username'] != $data['username'])
                {
                    if(AdminModel::getNum(array('username'=>$data['username']), 'sys_'))
                    {
                        return $this->showError('管理员账号已经存在!');
                    }
                }
                
                //总管理员的账号不能被禁止,也不能更换角色 
                if($adminer['id']==1 && ($data['status'] != 1 || $data['role'] != 1))
                {
                    return $this->showError('超级管理员不能被禁止,也不能更换角色!');
                }
                
                //不允许修改为总管理员
                if($adminer['id']!=1 && $data['role'] == 1 )
                {
                    return $this->showError('不允许修改为超级管理员!');
                }
                
                if(isset($data['pass'])) unset($data['pass']);
                $rs = AdminModel::update($id, $data, 'sys_');
                $this->doRecord('修改管理员:'.$data['realname']."-ID({$id})");
                
            }else{

                //新增管理员
                if(AdminModel::getNum(array('username'=>$data['username']), 'sys_'))
                {
                    return $this->showError('管理员账号已经存在!');
                }
                
                //修改管理员时的密码处理:不为空则使用默认密码
                $data['password']=empty($pass)?md5('123456'):md5($pass);
                
                //不允许新增总管理员
                if($data['role'] == 1 ) $this->showError('不允许新增超级管理员!');
                
                $data['ad_right'] = 'index/index|adminer/mypass';
                $id = AdminModel::insert($data, 'sys_');
                $this->doRecord('新增管理员:'.$data['realname']."-ID($id)");
            }
            $this->redirect('/Admin/Adminer/index');
        }
        
        //进入编辑页面
        $id=intval($id);
        $unit = array();
        if($id)
        {
            $unit = AdminModel::getOne($id, 'sys_');
            if(!$unit) $this->redirect('/Admin/Adminer');
        }

        $this->assign('unit', $unit);
        $this->assign('id', $id);
        $this->display();
    }

    //管理员修改自己的密码
    public function mypass()
    {
        //提交密码修改
        if(isset($_POST['pass']))
        {
            //取数据
            $data = I();
            $pass = isset($data['pass'])?trim($data['pass']):'';
            $pass1 = isset($data['pass1'])?trim($data['pass1']):'';
            $pass2 = isset($data['pass2'])?trim($data['pass2']):'';
            
            //基本判断
            if(strlen($pass)<6 || strlen($pass1)<6 || strlen($pass2)<6) $this->showError('密码均不得少于6位');
            if($pass1 != $pass2) $this->showError('重复密码不一致!');
            if($pass == $pass2) $this->showError('新旧密码不能一样!');
           
            //查询当前的用户密码
            $adminer = AdminModel::getOne($this->userId, 'sys_');
            if($adminer['password'] != md5($pass))
            {
                $this->showError('原始密码输入有误!');
            }

            //执行密码修改
            AdminModel::update($this->userId, array('password'=>md5($pass1)), 'sys_');
            $this->doRecord('管理员:'.$this->usernameName." 修改自己的密码-ID($this->userId)".'--即将自动退出后台');
            $this->redirect('/Admin/Login/loginout');
        }
        
        //显示界面
        return $this->display();
    }
    
    //管理员权限
    public function right($id =0)
    {
        //修改管理员的权限
        if(IS_POST)
        {
            $post = I();
            $thisId = intval(I('thisId'));
            unset($post['thisId']);
            if($thisId == 1 ) $this->showError('非法操作!');
            
            $adminer = AdminModel::getOne($thisId, 'sys_');
            if(!$adminer) $this->showError('非法操作!');
            
            //管理员必须拥有密码修改权限
            $must_array = array(
                'index/index'   =>1,    //欢迎界面
                'adminer/mypass'=>1,    //修改密码
                );
            $right_array = array_merge($post, $must_array);
            $right = implode('|', array_keys($right_array));

            AdminModel::update($thisId, array('right'=>$right), 'sys_');
            $this->doRecord('修改管理员权限:'.$adminer['username']."-ID($thisId)");
            $this->redirect('/Admin/adminer/index',array('id'=>$thisId));
        }
        
        //非提交展示权限页面
        $id = intval($id);
        if(!$id || $id==1) $this->showError('ID参数无效!');

        //读取数据
        $adminer = AdminModel::getOne($id, 'sys_');
        if(empty($adminer['id'])) $this->showError('管理员不存在!');
        
        //添加一些额外的权限
        $rightAll = $this->platSet['platMenu'];

        $this->assign('adminer', $adminer);
        $this->assign('ad_right', explode('|',$adminer['right']));
        $this->display($data);
    }
}
