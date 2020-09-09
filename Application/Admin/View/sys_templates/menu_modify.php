<layout name="layout" />
<block name="content">
<form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">菜单名称：</label>
        <div class="col-sm-8">
            <input type="text" name="showname" class="col-sm-3" value="<?php echo $id?$unit['showname']:'';?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">菜单所属级别：</label>
        <div class="col-sm-8">
            <select name="fatherid" class="col-xs-2 col-sm-3" >
                <?php foreach($fathermenu as $key=>$value){ ?>
                        <option value="<?php echo $key;?>" <?php if($id && $key==$unit['fatherid']) echo 'selected';?>><?php echo $value;?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">调用控制器/方法：</label>
        <div class="col-sm-8">
            <input type="text" name="keychar" class="col-sm-2" value="<?php echo $id?$unit['keychar']:'';?>" />
            <div class="help-block">&nbsp;顶级目录写控制器名称，其它项写方法名。比如调用MenuController只写menu即可</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">是否在菜单中隐藏：</label>
        <div class="col-sm-9">
            <label>
                <input name="hidden" value="0" type="radio" class="ace" <?php if(!$id || !$unit['hidden']) echo 'checked="checked"';?> >
                <span class="lbl"> 显示</span>
                &nbsp;
                <input name="hidden" value="1" type="radio" class="ace" <?php if($id && $unit['hidden']) echo 'checked="checked"';?>>
                <span class="lbl"> 隐藏</span>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">排序值：</label>
        <div class="col-sm-8">
            <input type="text" name="sortnum" class="col-sm-1" value="<?php echo $id?$unit['sortnum']:'';?>" />
            <div class="help-block">&nbsp;排序值越小越靠前</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 no-padding-right control-label">顶级菜单图标：</label>
        <div class="col-sm-2">
            <div class="input-group">
                 <input type="text" name="icon" value="<?php echo $id?$unit['icon']:''; ?>" class="form-control" placeholder="示例:icon-">
                 <span class="input-group-addon"><i class="<?php echo $id?$unit['icon']:''; ?>"></i></span>
            </div>
        </div>
        <div class="help-block">&nbsp;只有顶级菜单需要填写，其它不用填。<a href="http://www.runoob.com/bootstrap/bootstrap-glyphicons.html" target="_blank">点击查看可用图标列表</a></div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">直接跳转URL：</label>
        <div class="col-sm-8">
            <input type="text" name="fixurl" class="col-sm-6" placeholder="http://www..." value="<?php echo $id?$unit['fixurl']:'';?>" />
            <div class="help-block">&nbsp;如此菜单跳转至URL，请输入完整URL,只对二级菜单有效.</div>
        </div>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交-<span class='info'><?php echo $id?'修改':'新增'?></span>
                <input type="hidden" value="{$id}" name="id" >
            </button>
        </div>
    </div>
</form>
</block>
