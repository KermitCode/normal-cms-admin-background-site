<?php

/************************************
    *notes: 后台配置日志控制器
    *Author:956952515@qq.com
    *Time:  2018-09-15
*************************************/

namespace Admin\Controller;
use Admin\Model\AdminModel;
use Admin\Model\SettypeModel;

class ConfigController extends BaseController
{
    public function index()
    {
        //提取管理员列表
        $id = 1;

        //提交密码修改
        if(isset($_POST['id']))
        {
            //修改ID判断
            $newArr = I();
            unset($newArr['id']);

            foreach($newArr as $key=>$value)
            {
                $newArr[$key] = trim($value);
                $mustkeys = array('platname','compname','copyright');
                if(in_array($key, $mustkeys) && !$newArr[$key]) $this->showError('字段'. $key .'不能为空!');
            }

            //新增修改数据
            AdminModel::updateconfig($id, $newArr);
            $this->doRecord('修改-系统基础配置');
        }
        
        $confArr = AdminModel::getConfig();
        $this->assign('unit', $confArr);
        $this->assign('id', $id);
        $this->display('sys_templates/config_index');
    }


}
