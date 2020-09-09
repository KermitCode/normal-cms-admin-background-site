<?php

/************************************
	*notes:通用后台配置项/类别控制器
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;

class MenuController extends BaseController
{
    //读取任务列表
    public function index()
    {
        //取得菜单列表
        $data = AdminModel::getMenulist();
        $this->assign('data', $data);
        $this->display('sys_templates/menu_index');
    }
    
    //新增修改
    public function modify($id=0)
    {
        //修改
        if(isset($_POST) && isset($_POST['id']))
        {
            //修改ID判断
            $newArr = I();
            $mod_id = intval(I('id'));
            
            if(empty($newArr['showname']) || empty($newArr['keychar'])) 
            {
                $this->showError('菜单名称、调用控制器方法均不能为空！');
            }

            if(!$newArr['fatherid'] && empty($newArr['icon']))
            {
                $this->showError('顶级菜单必须要添加图标！');
            }

            //新增修改数据
            $newArr['lastmodify'] = YMDHIS; 
            $newArr['sortnum'] = intval($newArr['sortnum']);
            if($mod_id)
            {
                $record = "修改";
                unset($newArr['id']);
                AdminModel::updatemenu($mod_id, $newArr);
            }else{
                $record = "新增";
                unset($newArr['id']);
                $mod_id = AdminModel::addmenu($newArr);
            }
            $this->doRecord($record.'-菜单选项:'.$newArr['showname']);
            $this->redirect('/Admin/Menu/index');
        }
        
        //进入编辑页面
        $id=intval($id);
        $unit = array();
        if($id)
        {
            $unit = AdminModel::getMenuByid($id);
            if(!$unit) $this->redirect('/Admin/Activity/index');
        }

        $fathermenu = AdminModel::getFatherMenu();
        $this->assign('unit', $unit);
        $this->assign('fathermenu', $fathermenu);
        $this->assign('id', $id);
        $this->display('sys_templates/menu_modify');
    }
}
