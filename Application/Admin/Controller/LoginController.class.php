<?php

/************************************
	*notes: 后台登录控制器
	*Author:956952515@qq.com
	*Time:  2018-09-15
*************************************/

namespace Admin\Controller;

use Think\Controller;
use Admin\Model\AdminModel;

class LoginController extends BaseController
{
    //用户登录界面显示
    public function index()
	{
		//已登录用户跳转至用户中心
        $userid=session('userId');
		if($userid)
        {
            $this->redirect('/Admin/Index/index');
        }

		//处理提交数据
        $message = '';
        if(isset($_POST) && $_POST)
        {
            $data['username'] = I('admin_name');
            $data['password'] = I('pwd');
            $data['code'] 	  =	I('Code');

            //判断验证码
            $verify = new \Think\Verify();
            if($verify->check($data['code']))
            {
                //管理员验证处理程序
                if($data['username'] && $data['password'])
                {
                    $result = AdminModel::loginCheck($data['username']);
                    if(!$result || $result['password'] != md5($data['password']))
                    {
                        $message = 'ERROR:账号或密码错误';
                    }else{
                        session('userId', $result['id']); 
                        session('userName', $result['username']);
                        session('realName', $result['realname']);
                        session('userRole', $result['role']);
                        session('userRight', $result['right']);
                        session('userPhone', $result['phone']);
                        
                        //记录日志
                        $this->doRecord('登录管理平台', $result['id'], $result['realname']);
                        $this->redirect('/Admin/Index/index');
                    }
                }
            }else{
                $message = 'ERROR:验证码不正确';
            }
        }
        
		#加载登录界面
        $this->assign('platSet',$this->platSet);
		$this->assign('data',$data);
        $this->assign('message',$message);
        $this->assign('Verify',$Verify); 
        $this->display('sys_templates/login_index');
        $a = U();
    }
   
    //生成验证码
    public function makecode()
    {
        //验证码
        $codeConfig = array(
            'fontSize'=>14,
            'length'  =>4,
            'useNoise'=>true,
            'imageW'  =>95,
            'imageH'  =>29,
            'codeSet' =>'1234567890',
        );
        $Verify =  new \Think\Verify($codeConfig);
        $Verify->entry();
    }
    
	//用户退出
	public function loginout()
	{	
        if(session('userId') && session('realName'))
        {
            $this->doRecord('退出平台', session('userId'), session('realName'));
            session(null);
        }
        $this->redirect('/Admin/Login');
	}

}
