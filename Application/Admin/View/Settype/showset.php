<layout name="layout" />
<block name="content">
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
            <th>ID</th>
            <th>配置类别</th>
            <th>配置项名称</th>
            <th>配置项标识</th>
            <th>配置项类型</th>
            <th>排序值</th>
            <th>当前状态</th>
            <th>添加时间</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
	    <foreach name="pageData.list" item="row">
		<tr>
            <td>{$row.id}</td>
			<td>{$row.setname}</td>
            <td>{$row.config_name}</td>
            <td>{$row.config_key}</td>
            <td>{$platSet['htmltype'][$row['config_htmltype']]}</td>
			<td>{$row.sortnum}</td>
            <td>{$params['status'][$row['config_disable']]}</td>
            <td>{$row.addtime|date="Y-m-d H:i:s",###}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                   <button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo U('/Admin/settype/modsetkey',array('id'=>$row['id']));?>'">
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