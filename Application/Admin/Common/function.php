<?php

/************************************
	*notes:通用后台共用方法
	*Author:04007.cn
	*Time:2018-03-17
*************************************/

function safeCheck($data)
{
    if(!is_array($data)) return addslashes($data);
    $new = array();
    foreach($data as $key=>$value)
    {
        $new[addslashes($key)] = safeCheck($value);
    }
    return $new;
}

//将日期的时间去除
function getTimeInt($time)
{
	return str_replace(array(' ',':','-'), '', $time);
}

//判断输入的值是一个时间
function checkTime($time)
{
	$reg = '/^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/';
	return preg_match($reg, $time);
}

//取得年份数据
function getYear()
{
	$start = 2016;
	$end = date('Y')+1;
	$return = array();
	for($i= $start;$i<=$end;$i++)
	{
		$return[$i]= $i;
	}
	return $return;
}

//删除数组某值
function array_remove($array, $value)
{
	$key = array_search($value, $array);
	if($key === false) return $array;

	unset($array[$key]);
	return $array;
}

//根据下单时间计算剩余时间
function getRemain($ord_time)
{
	if(NOW_TIME > $ord_time+86400) return '已超时取消';
	$temp = 86400 -(NOW_TIME - $ord_time);
	
	#传回一个日、时、分的数组
	$returnArr=array();
	$returnArr['hour']=floor($temp/3600);
	$temp = $temp%3600;
	$returnArr['minute']=floor($temp/60);
	return "剩余{$returnArr['hour']}小时{$returnArr['minute']}分";
}

//在筛选条件前加上一个不限
function format($filter, $arr=array())
{
	if(!$arr) $arr = array(0=>'不限');
	//array_unshift
	foreach($filter as $key=>$value)
	{
		$arr[$key] = $value;
	}
	return $arr;
}

//去除数组里多余的KEY
function filtArr($array, $only)
{
	foreach($array as $key=>$value)
	{
		if(!in_array($key, $only) || $value==0) unset($array[$key]);
	}
	return $array;
}

function getSection($int)
{
	$int=intval($int);
	
	$char=array('一','二','三','四','五','六','七','八','九','十');
	
	if($int>100 || $int==0) return '';
	
	if($int>=1 && $int<=10) return $char[$int-1];
	
	if($int>=11 && $int<=99) return ($int<20?'':$char[floor($int/10)-1]).'十'.$char[$int%10 -1];

}

//显示sql
function sql($model='')
{
	echo 'Last Sql:'.M($model)->getLastSql();
	echo "<br>Db Error:".M($model)->getDbError();
	exit;
}

//排序函数:2016-08-31 周三
function sortDateKey($date1, $date2)
{
    return strtotime($date1) - strtotime($date2);
}

//时间的格式化
function ft($time='')
{
	if($time<1) return '';
	else return date('Y-m-d H:i:s', $time);
}

function verifyDate($val, $format = 'Y-m-d H:i:s') 
{
    $d = DateTime::createFromFormat($format, $val);
    return $d && $d->format($format) == $val ? $val : false;
}

function http_post($url, $params = array(), $headers = array(), $timeout = 1) 
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    
    $r = array();
    $r['content'] = curl_exec($ch);
    $r['http_info'] =curl_getinfo($ch);
    $r['http_info']['http_error'] = curl_error($ch);
    $r['http_info']['http_errno'] = curl_errno($ch);
    curl_close($ch);
    return $r['content'] ? $r['content'] : false;
} 

function makeImgUrl($img_host, $type, $cover)
{
    $cover = json_decode($cover, true);
    if (empty($cover) || empty($cover['file_id'])) {
        return '';
    }
    
    if ( empty($cover['ext'])) {
        $cover['ext'] = 'jpg';
    }

    $cover['ext'] = strtolower($cover['ext']);
    return sprintf('%s/%s/%s.%s', $img_host, $type, $cover['file_id'], $cover['ext']);
}


