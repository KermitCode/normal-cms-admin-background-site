<?php

/************************************
	*notes:通用后台一些供下拉选项配置
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

return array(
    'status'=>array( 0=>'<font color=red>禁用</font>', 1=>'启用中',),
    'role'=>array( 1=>'<font color=red>超级管理员</font>', 2=>'管理员',),
    'sex'=>array( 1=>'男', 0=>'<font color=red>女</font>',),
    'isnew'=>array( 1=>'<font color=red>新学员</font>', 0=>'老学员',),
	'isshow'=>array( 0=>'<font color=red>不显示</font>', 1=>'显示',),
	'yesorno'=>array( 0=>'<font color=red>否</font>', 1=>'是',),
    'nooryes'=>array( 1=>'<font color=red>是</font>', 0=>'否',),
	'newcourse'=>array( 1=>'<font color=red>新</font>', 2=>'老',),
	'class'=>array(	1=>'', 2=>'<font color=red></font>', 3=>''),
	'pay'=>array(
		0=>'<font color="red">已取消</font>',
		1=>'待支付',
		2=>'<font color="green">已支付</font>',
		3=>'<font color="brown">已审核退款</font>',
        ),
	'return'=>array(
		1=>'待审核',
		2=>'审核未通过',
		3=>'审核通过',
		4=>'待退款'
		)
);
