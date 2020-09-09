<layout name="layout" />
<block name="content">
<form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">类别标识：</label>
        <div class="col-sm-9">
            <div class="clearfix">
                <input type="text" name="setkey" class="col-xs-3 col-sm-2" <?php echo $id?"value='".$unit['setkey']."'":'';?> 
                <?php  if($id) echo "disabled";?>
                />
            </div>
            <div class="help-block">格式为全英文字符(可加下划线)，此为返回给端上配置数据时的类别KEY，新增后不再修改，以防端上取不到配置数据。</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置类别名称：</label>
        <div class="col-sm-9">
            <input type="text" name="setname" class="col-xs-10 col-sm-3" <?php echo $id?"value='".$unit['setname']."'":'';?> />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置类别描述：</label>
        <div class="col-sm-9">
            <div class="clearfix">
                <input type="text" name="settips" class="col-xs-10 col-sm-8" <?php echo $id?"value='".$unit['settips']."'":'';?> />
            </div>
            <div class="help-block">不需要过长，能提示用户此类别的意义即可。</div>
        </div>
    </div>
	<div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">排序值：</label>
        <div class="col-sm-5">
            <div class="clearfix">
                <input class="col-xs-3" type="text" id="form-field-5" name="sortnum"  value="<?php echo $id?$unit['sortnum']:'';?>" />
            </div>
        </div>
    </div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交-<span class='info'><?php echo $id?'修改配置类别':'新增配置类别'?></span>
                <input type="hidden" value="{$id}" name="id" >
            </button>
        </div>
    </div>
</form>
</block>