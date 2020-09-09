<layout name="layout" />
<block name="content">
<table id="sample-table-1" class="table table-striped table-bordered table-hover table-condensed">
	<thead>
            <tr>
                <th>ID</th>
                <th>是否顶级</th>
                <th>菜单名称</th>
                <th>菜单C/A</th>
                <th>图标</th>
                <th>隐藏</th>
                <th>排序值</th>
<!--                <th>锁定</th>-->
                <th>固定跳转URL</th>
                <th>操作</th>
            </tr>
	</thead>
	<tbody>
        <?php if(!empty($data)){ ?>
        <foreach name="data" item="row">
        <tr>
            <td>{$row.id}</td>
            <td><?php echo $row['fatherid']?'-':'+'; ?>
            <td><?php echo $row['fatherid']?('----'.$row['showname']):"<b>".$row['showname']."</b>"; ?></td>
            <td><?php echo $row['fatherid']?($data[$row['fatherid']]['keychar'].'/'.$row['keychar']):$row['keychar']; ?></td>
            <td><i class="{$row.icon}"></i></td>
            <td>{$params['nooryes'][$row['hidden']]}</td>
            <td>{$row.sortnum}</td>
        <!--    <td>{$params['nooryes'][$row['fix']]}</td>-->
            <td>{$row.fixurl}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                   <button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo U('/Admin/Menu/modify',array('id'=>$row['id']));?>'" <?php #if($row['fix']) echo "disabled";?>>
            			<i class="icon-edit bigger-120">编辑</i>
                   </button>					   
            	  
                </div>
            </td>
        </tr>
        </foreach>
        <?php }else{ ?>
            <tr>
                <td class="center" colspan="13">当前没有您要查询的记录</td>
            </tr>
         <?php }?>
	</tbody>
</table>
{$pageData['show']}
</block>
