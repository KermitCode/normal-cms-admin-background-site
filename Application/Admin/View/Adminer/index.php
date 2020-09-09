<layout name="layout" />
<block name="content">
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
            <th>ID</th>
            <th>姓名</th>
            <th>登录账号</th>
            <th>角色</th>
            <th>手机号</th>
            <th>当前状态</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
	    <foreach name="pageData.list" item="row">
		<tr>
            <td>{$row.id}</td>
			<td>{$row.realname}</td>
            <td>{$row.username}</td>
			<td>{$params['role'][$row['role']]}</td>
			<td>{$row.phone}</td>
			<td>{$params['status'][$row['status']]}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
				   <?php if($row['id'] == $userId || $userId==1){?>
                   <button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo U('/Admin/adminer/modify',array('id'=>$row['id']));?>'">
                   <i class="icon-edit bigger-120">编辑</i>
                   </button>
					   <?php if($row['id'] != 1 && $userId==1){?>
                       <button class="btn btn-xs btn-warning"  style="margin-left:15px;" onclick="window.location.href='<?php echo U('/Admin/adminer/right',array('id'=>$row['id']));?>'">
                       <i class="icon-edit bigger-120">分配权限</i>
                       </button>
                       <?php }?>
					   <?php if($row['id'] == 1 && $userId==1){?>
					   <span style="margin-left:15px;">最高权限</span>
					   <?php }?>
                   <?php }?>
                </div>
            </td>
		</tr>
		</foreach>
	</tbody>
</table>
{$pageData['show']}
</block>