<?php

/************************************
    *notes:用户模型
    *Author:04007.cn
    *Time:2018-03-17
*************************************/

namespace Admin\Model;
use Think\Model;

class UserModel extends BaseModel
{
    protected $tableName = 'user';

    static function pageList($where=1)
    {
        $M = M('user');
        
        $count = $M->where($where)->count();
        $Page  = new \Think\Page($count,10);
        $return['show'] = $Page->show();

        if (isset($where['uid'])) {
            $where['app_user.uid'] = $where['uid'];
            unset($where['uid']);
        }
        $return['list']  = $M->field('app_user.uid, app_user.username, app_user.realname, app_user.phone, app_user.weixin_id, app_user.addtime, app_usermore.*')
                             ->where($where)
                             ->join('app_usermore ON app_user.uid=app_usermore.uid')
                             ->order('id desc')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();
        return $return; 
    }

    static function getByUid($uid)
    {
        $M = M('user');
        $return = $M->field('app_user.*, app_usermore.golds, app_usermore.money, app_usermore.tudi_num, app_usermore.change_golds, app_usermore.out_cash, app_usermore.devote_golds, app_usermore.lasttime')
                    ->join('app_usermore ON app_user.uid=app_usermore.uid')
                    ->where(array('app_user.uid'=>$uid))
                    ->select();

        return current($return);
    }

    static function discipleList($userId,$condtion)
    {
        $result = array();
        $formatTable = '';
        if(!empty($userId))
        {
            $formatTable = sprintf('%s_%d', 'app_disciple', $userId%10);
        }
        $allRecord = M()->query(self::getDiscipleQuerySqlCount($formatTable, $condtion));
        $count = !empty($allRecord[0]['record']) ? $allRecord[0]['record'] : 0; 

        $Page  = new \Think\Page($count, 15);
        $result['show'] = $Page->show();
        $tailSql = "ORDER BY addtime DESC LIMIT  {$Page->firstRow}, {$Page->listRows}";
        $result['list']  = M()->query(self::getDiscipleQuerySql($formatTable, $condtion) . $tailSql);
        return $result;
    }

    static function getDiscipleQuerySql($table = '', $condtion = '')
    {
        $base = "SELECT id,uids,uidt,addtime FROM %s %s ";
        if($table)
        {
            return sprintf($base, $table, $condtion);
        }
        $sql = '';
        foreach(range(0,9) as $v) 
        {
            $sql .= sprintf(" (".$base.") ", "app_disciple_{$v}", $condtion) . 'UNION ALL ';
        }
        $sql = trim(trim($sql, ' '),'UNION ALL');
        return "SELECT * FROM ({$sql}) AS disciples ";
    }

    static function getDiscipleQuerySqlCount($table = '', $condtion = '')
    {
        $base = "SELECT COUNT(id) AS record FROM %s %s ";
        if(!empty($table))
        {
            return sprintf($base, $table, $condtion);
        }
        $sql = '';
        foreach(range(0,9) as $v) 
        {
            $sql .= sprintf(" (".$base.") ", "app_disciple_{$v}", $condtion) . 'UNION ALL ';
        }
        $sql = trim(trim($sql, ' '),'UNION ALL');
        return "SELECT SUM(record) AS record FROM ({$sql}) AS disciples ";
    }

    //用户总数
    static function getUserCount()
    {
        $sql = "SELECT count(1) as count FROM cmstemplate.app_user;";
        $M = M();
        $data = $M->query($sql);
        $data = current($data);
        return $data['count'];
    }

    //新增用户
    static function getNewUserCount($start = 0, $end = 0)
    {
        $sql = "SELECT FROM_UNIXTIME(addtime,'%Y-%m-%d') days,COUNT(id) COUNT FROM cmstemplate.app_user 
                WHERE addtime BETWEEN $start and $end GROUP BY days"; 
        $M = M();
        $data = $M->query($sql);

        return $data;
    }

    //新增微信绑定
    static function getNewWxCount($start = 0, $end = 0)
    {
        $sql = "SELECT FROM_UNIXTIME(weixin_time,'%Y-%m-%d') days,COUNT(id) COUNT FROM cmstemplate.app_user 
                WHERE weixin_time BETWEEN $start and $end GROUP BY days"; 
        $M = M();
        $data = $M->query($sql);

        return $data;
    }

    //获取徒弟数
    static function getTudiCount($start = 0, $end = 0)
    {
        $whereSql = " WHERE addtime BETWEEN $start and $end ";
        $sql = <<<EOF
SELECT sum(COUNT) as COUNT, days from (
SELECT FROM_UNIXTIME(addtime,'%Y-%m-%d') days,COUNT(distinct uidt) COUNT FROM cmstemplate.app_disciple_0 $whereSql
) as td group by days;
EOF;

        $M = M();
        $data = $M->query($sql);

        return $data;
    }

    //拜师数
    static function getShifuCount($start = 0, $end = 0)
    {
        $whereSql = " WHERE addtime BETWEEN $start and $end ";
        $sql = <<<EOF
SELECT sum(COUNT) as COUNT, days from (
SELECT FROM_UNIXTIME(addtime,'%Y-%m-%d') days,COUNT(distinct uids) COUNT FROM cmstemplate.app_disciple_0 $whereSql
) as td group by days;
EOF;

        $M = M();
        $data = $M->query($sql);

        return $data;
    }
}
