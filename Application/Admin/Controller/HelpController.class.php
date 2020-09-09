<?php

/************************************
    *notes:通用后台操作日志控制器
    *Author:04007.cn
    *Time:2018-03-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\QaModel;

class HelpController extends BaseController
{
    public function qa()
    {
        //数据筛选
        $where = array();
        $filter = array('cateid');
        foreach(I() as $key=>$value)
        {
            $value = trim($value);
            if(in_array($key, $filter) && $value) $where[$key] = $value;
        }
        $pageData = QaModel::getPageList($where);

        $this->assign('where', $where);
        $this->assign('pageData', $pageData);
        $this->assign('categories', QaModel::$cateMaps);
        $this->display();
    }

    //list qa
    public function listqa()
    {
        $data = QaModel::getAll('sys_');
        $this->assign('data', $data);
        $this->display();
    }

    public function modqa($id=0)
    {
        //修改
        if(isset($_POST) && isset($_POST['id'])) {

            //修改ID判断
            $newArr = I();
            $mod_id = intval(I('id'));

            if ( !in_array($newArr['cateid'], array_keys(QaModel::$cateMaps))) {
                $this->showError('问题分类不存在!');
            }

            if (empty($newArr['question'])) {
                $this->showError('请填写问题描述!');
            }

            if (mb_strlen($newArr['question']) > 200) {
                 $this->showError('问题描述太长了!');
            }

            if (empty($newArr['answer'])) {
                $this->showError('请填写问题答案!');
            }
            $newArr['answer'] = nl2br($newArr['answer']);

            if (mb_strlen($newArr['answer']) > 20000) {
                 $this->showError('问题答案太长了!');
            }

            //更新时间
            if (!$mod_id) {
                $newArr['addtime'] = time();
            }

            //新增修改数据
            if($mod_id)
            {
                $record = "修改";
                unset($newArr['id']);
                $newArr['lastmodify'] = time();
                // echo '<pre>';
                // var_dump(strpos($newArr['answer'], "\n"));
                // var_dump($newArr['answer']);exit;
                QaModel::update($mod_id, $newArr, 'sys_');
            }else{
                $record = "新增";
                unset($newArr['id']);
                $mod_id = QaModel::insert($newArr, 'sys_');
            }
            $this->doRecord($record.'-常见问题:'.$newArr['question']);
            $this->redirect('/Admin/help/qa');
        }

        $unit = array();
        if($id)
        {
            $unit = QaModel::getOne($id, 'sys_');
            if(!$unit) $this->redirect('/Admin/help/qa');
            $unit['answer'] = preg_replace('/<br\\s*?\/??>/i','',$unit['answer']);
        }

        $this->assign('id', $id);
        $this->assign('unit', $unit);
        $this->assign('categories', QaModel::$cateMaps);
        $this->display();
    }
}
