<?php

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\UserModel;
use Admin\Model\AdminModel;

class UserController extends BaseController
{
    //用户列表
    public function index()
    {
        //提取管理员列表
        $adminerArr = AdminModel::listall();

        //数据筛选
        $where = array();
        $filter = array('uid','username');
        foreach(I() as $key=>$value)
        {
            $value = trim($value);
            if(in_array($key, $filter) && $value) $where[$key] = $value;
        }
        
        $pageData = UserModel::pageList($where);

        $this->assign('where', $where);
        $this->assign('adminerArr', $adminerArr);
        $this->assign('pageData', $pageData);
        $this->display();
    }

    public function disciple()
    {
        //数据筛选
        $params = array();
        $condtion = '';
        $user = I();
        if(!empty($user['uid']))
        {
            $params['uid'] = $user['uid'];
            $condtion.= ' AND uids = ' . $params['uid'];
        }

        if(!empty($condtion))
        {
            $condtion = ' WHERE ' . trim($condtion, ' AND ');
        }

        $pageData = UserModel::discipleList($user['uid'], $condtion);

        $this->assign('filter', $params);
        $this->assign('pageData', $pageData);
        $this->display();
    }

    //用户信息
    public function view()
    {
        $uid = I('uid');
        if(empty($uid)) {
            $this->showError('参数错误!');
        }
        $unit = UserModel::getByUid($uid);
        if (empty($unit)) {
            $this->showError('用户不存在!');
        }

        // echo '<pre>';
        // print_r($unit);exit;
        $this->assign('unit', $unit);
        $this->display();
    }
}
