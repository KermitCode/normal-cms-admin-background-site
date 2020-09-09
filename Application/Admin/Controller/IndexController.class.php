<?php

/************************************
	*notes:后台首页控制器
	*Author:
	*Time: 2018-09-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\CashModel;

class IndexController extends BaseController
{
    //后台管理首页.
    public function index()
    {
        $this->assign('taskNum', $taskNum);
        $this->display('sys_templates/index_index');
    }

}
