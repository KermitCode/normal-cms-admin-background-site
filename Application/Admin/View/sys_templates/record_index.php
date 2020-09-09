<layout name="layout" />
<block name="content">
<script src="{$baseUrl['imgUrl']}jquery_17min.js"></script>
<div class="widget-main">
	<form class="form-inline" method="get" name="filter" action="">
		<b>筛选 </b> 
		管理员：
		<select name="uid">
			<?php foreach(format($adminerArr) as $key=>$value){?>
				<option value='<?php echo $key;?>' <?php if(isset($where['uid']) && $key==$where['uid']) echo 'selected';?>><?php echo $value;?></option>
			<?php }?>
		</select>
		搜索操作描述：
		<input type="text" name="searchkey" class="input-middle" value="<?php echo isset($where['searchkey'])?$where['searchkey']:'';?>">
		<input type="hidden" name="p" value="1">
	</form>
</div>
<script language="javascript">
$(document).ready(function(){
	$("form[name='filter']").children('select').change(function(){
		document.filter.submit();
	});
	$("input[name='searchkey']").blur(function(){
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
                        <th class="center">ID</th>
                        <th>操作人类别</th>
                        <th>操作人姓名</th>
                        <th>操作人UID</th>
                        <th>操作描述</th>
                        <th>操作IP</th>
                        <th>操作时间</th>
                    </tr>
                </thead>
                <tbody>
                   <foreach name="pageData.list" item="record">
                        <tr>
                            <td class="center">{$record.id}</td>
                            <td class="center">{$params['role'][$record['usertype']]}</td>
                            <td>{$record.username}</td>
                            <td>{$record.uid}</td>
                            <td>{$record.dowhat}</td>
                            <td>{$record.doip}</td>
                            <td>{$record.dotime|date="Y-m-d H:i:s",###}</td>
                        </tr>
                   </foreach>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->
{$pageData['show']}
</block>
