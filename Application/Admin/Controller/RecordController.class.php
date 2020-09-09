<?php

/************************************
	*notes:通用后台操作日志控制器
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\RecordModel;
use Admin\Model\AdminModel;

class RecordController extends BaseController
{
    public function index()
    {
        //提取管理员列表
        $adminerArr = AdminModel::listall();

        //数据筛选
        $where = array();
        $filter = array('uid','searchkey');
        foreach(I() as $key=>$value)
        {
            $value = trim($value);
            if(in_array($key, $filter) && $value) $where[$key] = $value;
        }
        
        $pageData = RecordModel::pageList($where);
        
        $this->assign('where', $where);
        $this->assign('adminerArr', $adminerArr);
        $this->assign('pageData', $pageData);
        $this->display('sys_templates/record_index');
    }


}
