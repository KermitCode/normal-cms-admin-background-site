<layout name="layout" />
<block name="content">
<script src="{$baseUrl['imgUrl']}jquery_17min.js"></script>
<!-- 搜索 -->
<div class="widget-main">
    <form class="form-inline" method="get" name="filter" action="">
        <b>筛选 </b> 
        分类：
        <select name="cateid">
            <option value="">全部</option>
            <option value="">提现问题</option>
            <?php foreach ($categories as $k => $v): ?>
            <option value=<?php echo $k;?> <?php if ($where['cateid'] == $k) echo "selected";?>><?php echo $v;?></option>
            <?php endforeach;?>
        </select>
        <input type="hidden" name="p" value="1">
        <input class="btn-info btn-sm btn" type="submit" name="submit" value="查询">
    </form>
    
</div>
<!-- 列表 -->
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
    <thead>
            <tr>
                <th>ID</th>
                <th>分类</th>
                <th>问题</th>
                <th>状态</th>
                <th>排序</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
    </thead>
    <tbody>
        <?php if(!empty($pageData['list'])){ ?>
        <foreach name="pageData.list" item="row">
        <tr>
            <td>{$row.id}</td>
            <td>{$row.catename}</td>
            <td>{$row.question}</td>
            <td>
                <?php if ($row['enabled']): ?>
                    <span style="color:green">启用</span>
                <?php else: ?>
                    <span style="color:red">禁用</span>
                <?php endif;?>
            </td>
            <td>{$row.sortnum}</td>
            <td>{$row.lastmodify|date="Y-m-d H:i",###}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                   <button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo U('/Admin/help/modqa',array('id'=>$row['id']));?>'">
                        <i class="icon-edit bigger-120">编辑</i>
                   </button>                       
                  
                </div>
            </td>
        </tr>
        </foreach>
        <?php }else{ ?>
            <tr>
                <td class="center" colspan="12">当前没有您要查询的记录</td>
            </tr>
         <?php }?>
    </tbody>
</table>
{$pageData['show']}
</block>