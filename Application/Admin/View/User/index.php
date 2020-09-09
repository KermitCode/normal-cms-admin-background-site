<layout name="layout" />
<block name="content">
<script src="{$baseUrl['imgUrl']}jquery_17min.js"></script>
<div class="widget-main">
    <form class="form-inline" method="get" name="filter" action="">
        <b>筛选 </b> 
        用户id：
        <input type="text" name="uid" class="input-middle" value="<?php echo isset($where['uid'])?$where['uid']:'';?>">
        用户名：
        <input type="text" name="username" class="input-middle" value="<?php echo isset($where['username'])?$where['username']:'';?>">

        <input type="hidden" name="p" value="1">
        <input class="btn-info btn-sm btn" type="submit" name="submit" value="查询">
    </form>
    
</div>
<script language="javascript">
$(document).ready(function(){
    $("input[name='submit']").click(function(){
        document.filter.submit();
    });
    /* 日期选择 */
    jQuery('.date-range-picker').daterangepicker({
        'format':'YYYY-MM-DD',
        'separator':'|',
        'locale':{
            'applyLabel':'选择',
            'cancelLabel':'取消'
        }
    });
});
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">用户id</th>
                        <th>用户名</th>
                        <th>手机号</th>
                        <th>徒弟数</th>
                        <th>金币数</th>
                        <th>累计转换金币</th>
                        <th>现金(单位元)</th>
                        <th>累计提现(单位元)</th>
                        <th>微信绑定</th>
                        <th>创建时间</th>
                        <th>详情</th>
                    </tr>
                </thead>
                <tbody>
                   <?php if(!empty($pageData['list'])){ ?>
                   <foreach name="pageData.list" item="record">
                        <tr>
                            <td class="center">{$record.uid}</td>
                            <td class="">{$record.username}</td>
                            <td>{$record.phone}</td>
                            <td><a title="徒弟列表"  href="/admin/user/disciple.html?uid={$record.uid}">{$record.tudi_num}</a></td>
                            <td><a title="金币明细" href="/admin/money/jinbi.html?uid={$record.uid}">{$record.golds}</a></td>
                            <td>{$record.change_golds}</td>
                            <td><a title="现金明细" href="/admin/money/lingqian.html?uid={$record.uid}"><?php echo $record['money']/100;?>元</a></td>
                            <td><a title="提现记录" href="/admin/money/tixian.html?uid={$record.uid}"><?php echo $record['out_cash']/100;?>元</a></td>
                            <td>
                                <?php echo $record['weixin_id'] ? '<span style="color:green">是</span>' 
                                : '<span style="color:red">否</span>'; ?>
                            </td>
                            <td>{$record.addtime|date="Y-m-d H:i:s",###}</td>
                            <td><a href="/admin/user/view.html?uid={$record.uid}">详情</a></td>
                        </tr>
                   </foreach>
                   <?php }else{ ?>
                        <tr>
                            <td class="center" colspan="11">当前没有您要查询的记录</td>
                        </tr>
                   <?php }?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->
{$pageData['show']}
</block>