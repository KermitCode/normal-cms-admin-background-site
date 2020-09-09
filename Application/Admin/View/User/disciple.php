<layout name="layout" />
<block name="content">
<div class="widget-main">
    <form class="form-inline" method="get" name="filter" action="">
        <b>筛选 </b> 
        用户id：
        <input type="text" name="uid" class="input-middle" value="<?php echo isset($filter['uid'])?$filter['uid']:'';?>">
        <input type="hidden" name="p" value="1">
        <input class="btn-info btn-sm btn" type="submit" name="submit" value="查询">
    </form>
    
</div>
<script language="javascript">
$(document).ready(function(){
    $("input[name='submit']").click(function(){
        document.filter.submit();
    });
});
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>师傅UID</th>
                        <th>徒弟UID</th>
                        <th>拜师时间</th>
                    </tr>
                </thead>
                <tbody>
                   <?php if(!empty($pageData['list'])){ ?>
                   <foreach name="pageData.list" item="record">
                        <tr>
                            <td>{$record.uids}</td>
                            <td><a title="用户详情" href="/admin/user/view.html?uid={$record.uidt}">{$record.uidt}</a></td>
                            <td>{$record.addtime|date="Y-m-d H:i:s",###}</td>
                        </tr>
                   </foreach>
                   <?php }else{ ?>
                        <tr>
                            <td class="center" colspan="3">当前没有您要查询的记录</td>
                        </tr>
                   <?php }?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->
{$pageData['show']}
</block>