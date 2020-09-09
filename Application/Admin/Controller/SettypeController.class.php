<?php

/************************************
	*notes:通用后台配置项/类别控制器
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\SettypeModel;
use Admin\Model\SetkeyModel;


class SettypeController extends BaseController
{
    //读取配置类别列表
    public function index()
    {
        $pageData = SettypeModel::pageList();
        $this->assign('pageData', $pageData);
        $this->display();
    }
    
    //新增修改配置类别
    public function modtype($id=0)
    {
        //修改
        if(isset($_POST) && isset($_POST['id']))
        {
            //修改ID判断
            $newArr = I();
            $mod_id = intval(I('id'));

            if(empty($newArr['setname']) || empty($newArr['settips']) || empty($newArr['sortnum']))
            {
                $this->showError('各字段均不能为空!');
            }

            //新增修改数据
            if($mod_id)
            {
                $record = "修改";
                unset($newArr['id'],$newArr['setkey']);
                SettypeModel::update($mod_id, $newArr);
            }else{
                $record = "新增";
                unset($newArr['id']);
                $mod_id = SettypeModel::insert($newArr);
            }
            $this->doRecord($record.'-配置类别:'.$newArr['setname']);
            $this->redirect('/Admin/Settype/index');
        }
        
        //进入编辑页面
        $id=intval($id);
        $unit = array();
        if($id)
        {
            $unit = SettypeModel::getOne($id);
            if(!$unit) $this->redirect('/Admin/Settype/index');
        }

        $this->assign('unit', $unit);
        $this->assign('id', $id);
        $this->display();
    }
  
    //三端底层的调用配置展示
    protected function showset($platf)
    {
        $pageData = SetkeyModel::pageList($platf);
        $this->assign('pageData', $pageData);
        $this->display('showset');
    }

    //安卓配置
    public function android()
    {
        $this->showset('android');
    }

    //IPHONE配置
    public function ios()
    {
        $this->showset('ios');
    }
    
    //IPAD配置
    public function ipad()
    {
        $this->showset('ipad');
    }
    
    //三端调用修改某个配置项
    public function modsetkey($id=0)
    {
        //读取配置项列表
        $settype_Arr = SettypeModel::listField('setname');

        //修改或新增
        if(!empty($_POST))
        {
            //修改ID判断
            $newArr = I();
            $mod_id = intval(I('id'));
            //print_r($settype_Arr);print_r($this->platSet['platf']);print_r($this->platSet['htmltype']);$this->showTest($newArr);    
            if(!isset($settype_Arr[$newArr['settype_id']]) || !isset($this->platSet['htmltype'][$newArr['config_htmltype']]) )
            {
                $this->showError('参数有误，当前存在注入行为!');
            }
            
            if(!$mod_id && !in_array($newArr['platf'], $this->platSet['platf']))
            {
                $this->showError('参数有误，当前存在平台注入行为!');
            }

            if(empty($newArr['config_key']) || empty($newArr['config_name']))
            {
                $this->showError('配置项标识/名称不得为空!');
            }

            //新增修改数据
            if($mod_id)
            {
                $record = "修改";
                unset($newArr['platf']);
                SetkeyModel::update($mod_id, $newArr);
            }else{
                $record = "新增";
                unset($newArr['id']);
                $mod_id = SetkeyModel::insert($newArr);
            }
            $this->doRecord($record.$newArr['platf'].'-配置项:'.$newArr['config_key']);
            $this->redirect('/Admin/Settype/modsetkey',array('id'=>$mod_id));
        }
        
        //进入编辑页面
        $id=intval($id);
        $unit = array();
        if($id)
        {
            $unit = SetkeyModel::getOne($id);
            if(!$unit) $this->redirect('/Admin/Settype/index');
        }

        $this->assign('settype_Arr', $settype_Arr);
        $this->assign('unit', $unit);
        $this->assign('id', $id);
        $this->display();
    }

}
