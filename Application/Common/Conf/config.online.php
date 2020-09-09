<?php

/************************************
	*notes:通用后台项目运行配置
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

return array(
    'APP_DEBUG' => false,
    'TMPL_CACHE_ON'   => false,
    'SHOW_PAGE_TRACE' => false,
    'SHOW_ERROR_MSG'    =>  true,    // 显示错误信息
    
	'MODULE_ALLOW_LIST'    =>   array('Front','Admin'),
	'DEFAULT_MODULE'       =>   'Admin',
	'DEFAULT_CONTROLLER'   =>	'login', 
    'DEFAULT_CHARSET'       =>  'utf-8', 
    'URL_CASE_INSENSITIVE'  =>  true,
    'URL_MODEL'             =>  2, 
    'TMPL_TEMPLATE_SUFFIX'  =>  '.php',     // 默认模板文件后缀
	/*'SESSION_OPTIONS'=> array(
		'expire'=>'30',
		'use_only_cookies'    =>  0,
	),*/

    //加载数据库配置
    'LOAD_EXT_CONFIG' => array('dbconfig', 'menu'=>'menu', 'params'=>'params','platset'=>'platset'),
	//'SHOW_PAGE_TRACE' =>true, 
    'DATA_CACHE_CHECK'  =>  true,   // 数据缓存是否校验缓存
	'HTML_CACHE_ON'     => false,
    //'APP_AUTOLOAD_PATH' => 'Common.Extend.Htmlhelp',

    //Redis
    'REDIS_HOST' => '192.168.168.35',
    'REDIS_PORT' => 7379,
    'REDIS_TIMEOUT' => 30,
    'REDIS_PERSISTENT' => false,
    'REDIS_AUTH' => '',

    //头条接口
    'API_URL'    => 'http://api.com',
    'API_APPKEY' => 'IEUQ9098761KJUI',
);