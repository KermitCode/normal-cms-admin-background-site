<?php

/************************************
	*notes: 后台基类控制器
	*Author:956952515@qq.com
	*Time:  2018-09-15
*************************************/

/**
	备注：
	全局用户是否登录：		调用$this->userId;
	全局用户详情数据：		调用$this->session或者直接使用$this->realName等;
	全局平台设置数据：		调用$this->platSet;
	全局测试显示方法：		调用$this->showTest;
    全局各种URL数据：		调用$this->baseUrl;
**/

namespace Admin\Controller;
use Think\Controller;

#平台基类控制器
class BaseController extends Controller 
{
    protected $baseUrl, $platSet;
    
	#控制器实例化
    public function __construct()
	{
        //加载平台全局一些路径及平台基础设置
        parent::__construct();
        $this->initBaseUrl();
        $this->platSet = $this->initPlatset();

        //定义一些常量
        $microTime = gettimeofday();
        define('TIME', $microTime['sec']);
        define('YMDHIS', date('Y-m-d H:i:s', TIME));

        //需登录的控制器执行登录判断
        $notInit = array('login', 'job');
        $tempController = strtolower(CONTROLLER_NAME);
        if(!in_array($tempController, $notInit))
        {
            $this->initPlat();
        }
	}
    
    //初始化平台基础数据
    public function initBaseUrl()
    {
        $this->baseUrl = array();
        $port=I('server.SERVER_PORT');
		$this->baseUrl['fullUrl'] = 'http://'.I('server.HTTP_HOST').__ROOT__;
        $this->baseUrl['absUrl'] = trim(__ROOT__, '.');
        $this->baseUrl['imgUrl'] = trim(__ROOT__.'/backend/', '.');
        $this->baseUrl['controllerName'] = strtolower(CONTROLLER_NAME);
        $this->baseUrl['actionName'] = strtolower(ACTION_NAME);
        $this->baseUrl['userIp'] = get_client_ip();
		$this->assign('baseUrl',$this->baseUrl);
    }
	
    //初始化平台配置
    public function initPlatset()
    {
        $data = \Admin\Model\AdminModel::getConfig();
        unset($data['id']);
        $data['settgradeone'] = array_filter(explode('|', $data['settgradeone']));
        $data['settgradetwo'] = array_filter(explode('|', $data['settgradetwo']));
        return $data;
    }

	//初始化平台数据
	public function initPlat()
	{
        //对用户当前登录状态进行处理
		$this->checkOn();

		//加载平台设置：如需要对数据进行缓存
        $this->platSet['platMenu'] = $this->getMenu();
        $this->platSet['breadCrumbs'] = $this->getBreadcrumbs();

        //加载扩展配置
        $this->params = C('params');
        $this->assign('params', $this->params);
		$this->assign('platSet',$this->platSet);
        
        //检查管理员的操作权限
        $nowAction = $this->baseUrl['controllerName'].'/'.$this->baseUrl['actionName'];
        $nowRight = session('userRight');
        if($nowRight!='all')
        {
            $nowRight = array_flip(explode('|', $nowRight));
            if(!isset($nowRight[$nowAction])) $this->showError('您没有此操作权限，请联系管理员。');  
        }
	}

	//用户登录状态
	public function checkOn()
	{
		#读取SESSION数据
		$value = session();
        if(!isset($value['userId']))
        {
            $this->redirect('/Admin/Login');
        }
        
        foreach($value as $k =>$v)
        {
            $this->$k = $v;
        }
        $this->assign('session',$value);
	}
	
	#执行消息插入
	public function insertMsg($uid,$cont)
	{
		return $this->Globals->insertMsg($uid,$cont);	
	}
	
	#用于测试展示数据
	public function showTest($data,$stop=true)
	{
		header("Content-type:text/html;charset=utf-8");
		echo '<pre>';print_r($data);echo '</pre>';
		if($stop) exit;		
	}
    
    //取得页面上的面包悄
    protected function getBreadcrumbs()
    {
        $menu = $this->getMenu();
        $breadCrumbs = array('后台管理系统'=>U('/Admin/Index'));
        if(isset($menu[$this->baseUrl['controllerName']]['child']))
        {
            $breadCrumbs[$menu[$this->baseUrl['controllerName']]['name']] = U("/Admin/{$this->baseUrl['controllerName']}");
            if(array_key_exists($this->baseUrl['actionName'], $menu[$this->baseUrl['controllerName']]['child']))
            {
                $breadCrumbs[$menu[$this->baseUrl['controllerName']]['child'][$this->baseUrl['actionName']]['name']] = '#';
            }

        }else{
            $breadCrumbs[$menu[$this->baseUrl['controllerName']]['name']] = '#';
        }
        return $breadCrumbs;
    }
    
    //总管理员的操作记录
    public function doRecord($what, $uid='', $username='')
    {
        $insertArr=array(
            'usertype'=>1,
            'uid'=>$uid?$uid:$this->userId,
            'username'=>$username?$username:$this->realName,
            'dowhat'=>$what,
            'doip'=>$this->baseUrl['userIp'],
            'dotime'=>time()
        );
        M('record', 'sys_')->add($insertArr);
    }
    
    //总台台全局错误展示页面
    public function showError($error='', $file='/error')
    {
        $this->assign('error', $error);
        $this->display($file);
        exit;
    }
    
    //全局跳转至上一页
    public function goback()
    {
		header("Content-type:text/html;charset=utf-8");
        die("<script language=\"javascript\">window.history.go(-1);</script>");
	}
    
    //后台管理的菜单
    protected function getMenu()
    {
        $menu = \Admin\Model\AdminModel::getMenuarr();
        return $menu;
    }
    
    //通用数据插入方法,主要供管理后台直接ajax调用.
    public function insertdata($table, $data)
    {
        //提供整个后台各端直接使用此接口插入数据
    }
    
    //测试显示数据
    public function debug( $data )
    {
        #$order = 1;
        #foreach($data as $value)
        #{
            echo str_repeat('-', 30) . "<b>DebugValue:{$order}</b>" .str_repeat('-', 30).'<pre>';
            print_r($value);
            echo '</pre>';
        #    $order++;
        #}
    }

    public function upload($type, $file)
    {
        #$files = $_FILES[$file];
        #$exts =  array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        #$result = ['status'=>1, 'error'=>'', 'data'=>[]];
        #$ext = pathinfo($files['name'], PATHINFO_EXTENSION);
        # 
        #if(!in_array($ext, $exts))//验证扩展合法性
        #{
        #    $result['status'] = 0;
        #    $result['error'] = '仅支持上传的文件扩展:'.implode(',', $exts);
        #    return $result;
        #}

        #$data = ['subdir'=>$type, 'field' => new \CURLFile($files['tmp_name'])];
    
        #$imgResult = http_post($this->platSet['upload_img'], $data);
        #
        #if(false !== $imgResult)
        #{
        #    $imgs = json_decode($imgResult,true);
        #    if(!$imgs['status'])
        #    {
        #        $result['status'] = 1;
        #        $result['error'] = '';
        #        $result['data'] = $imgs['result'];
        #        return $result;
        #    }

        #    $result['status'] = 0;
        #    $result['error'] = $imgs['msg'];
        #    return $result;
        #}
        #
        #$result['status'] = 0;
        #$result['error'] = '文件上传失败';
        #return $result;
    }

}
