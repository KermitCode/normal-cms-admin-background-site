<layout name="layout" />
<block name="content">
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
            <th>ID</th>
            <th>配置类别名称</th>
            <th>配置类别标识</th>
            <th>配置类别描述</th>
            <th>排序值</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
	    <foreach name="pageData.list" item="row">
		<tr>
            <td>{$row.id}</td>
			<td>{$row.setname}</td>
            <td>{$row.setkey}</td>
            <td>{$row.settips}</td>
			<td>{$row.sortnum}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                   <button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo U('/Admin/settype/modtype',array('id'=>$row['id']));?>'">
						<i class="icon-edit bigger-120">编辑</i>
                   </button>					   
				  
                </div>
            </td>
		</tr>
		</foreach>
	</tbody>
</table>
{$pageData['show']}
</block>