<?php

/************************************
	*notes:通用各端具体配置处理器
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\SettypeModel;
use Admin\Model\SetkeyModel;
use Admin\Model\SetvalModel;

import('Htmlhelp', APP_PATH.MODULE_NAME."/Common");
use \Htmlhelp;

class SetvalController extends BaseController
{
    //新增修改配置类别
    public function index($platf='')
    {
        if(!$platf) $this->showError('你当前正在进行注入操作!');
       
        //读取配置项列表
        $settype_Arr = SettypeModel::listField('setname');
        
        if(isset($_POST) && $_POST['form_id'])
        {
            //修改ID判断
            $newArr = I();
            @list($platf, $mtype, $settype_id) = explode('_', $newArr['form_id']);
            if(!in_array($platf, $this->platSet['settgradeone']) || !isset($settype_id, $settype_Arr) || !in_array($mtype, $this->platSet['settgradetwo']) )
            {
                $this->showError('参数有误，当前存在注入行为!');
            }

            //取得当前平台、配置类型的全部可配项
            $set_Arr = SetkeyModel::listField('config_key', $where = array(
                'settgradeone'=>$platf, 'settype_id'=>$settype_id
            ));

            //数据处理
            unset($newArr['form_id']);
            foreach($newArr as $key=>$value)
            {
                if(is_array($value)) $newArr[$key] = implode('|', $value);
                elseif($value === '') $this->showError("所有配置不得为空，请检查配置:{$key}");
                
                $setKey_id = array_search($key, $set_Arr);
                if(!$setKey_id) $this->showError('当前存在注入行为!');
                
                $data[$setKey_id] = $newArr[$key];
            }
            
            $record = "修改";
            foreach($data as $key=>$value)
            {
                SetvalModel::insertOnDuplicateKeyUpdate(array(
                    'settgradeone'=>$platf,
                    'settgradetwo'=>$mtype,
                    'settype_id'=>$settype_id,
                    'setkey_id'=>$key), array('setval'=>$value,'lastmodify'=>YMDHIS));
            }
  
            $this->doRecord($record.ucfirst($platf)."-{$mtype}机型-{$settype_Arr[$settype_id]}");
            $this->redirect("/Admin/Setval/{$platf}");
        }
        
        //读取当前平台的配置项.并根据配置类型分组.
        $allData = SetkeyModel::allList($platf);
        
        //读取当前平台各机型的全部配置数据
        $allSetData = SetvalModel::listSetval($platf);

        //将配置生成HTML
        $htmlArr = array();
        foreach($this->platSet['settgradetwo'] as $m)
        {
            $tempArr = array();
            foreach($allData as $settype=>$setArr)
            {
                $html = '';
                foreach ($setArr as $setid=>$set)
                {
                    $default = isset($allSetData[$m][$set['settype_id']][$setid])?$allSetData[$m][$set['settype_id']][$setid]:false;
                    $html .= Htmlhelp::makeInput($set, $default);  
                }
                $tempArr[]=array(
                    'settype_id'=>$set['settype_id'],
                    'setname'=>$set['setname'],
                    'sethtml'=>$html,
                );
            }
            $htmlArr[$m] = $tempArr;
        }
        
        #$this->debug($allSetData,$htmlArr);exit;
        $this->assign('platf', $platf);
        $this->assign('htmlArr', $htmlArr);
        $this->display('index');
    }
    
    public function android()
    {
        $this->index('android');
    }
    
    public function ios()
    {
        $this->index('ios');
    }
    

}
