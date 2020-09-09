<layout name="layout" />
<block name="content">
<form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?php echo $platSet['gradeonename']; ?>：</label>
        <div class="col-sm-8">
            <select name="platf" class="col-xs-2 col-sm-2" id="form-field-select-1" <?php if($id) echo 'disabled';?> >
                <?php foreach($platSet['settgradeone'] as $key=>$value){ ?>
                        <option value="<?php echo $value;?>" <?php if($id && $value==$unit['settgradeone']) echo 'selected';?>><?php echo $value;?></option>
                <?php }?>
            </select>
			<div class="help-block"> &nbsp;此项在系统基础配置中修改，设定后不能随意修改。</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-2">配置项所属配置类别：</label>
        <div class="col-sm-9">
            <select name="settype_id" class="col-xs-10 col-sm-5" id="form-field-select-1">
                <?php foreach($settype_Arr as $value => $show){?>
                    <option value="<?php echo $value;?>" <?php if($id && $value==$unit['settype_id']) echo 'selected';?>><?php echo $show;?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置项标识：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" name="config_key" class="col-xs-3 col-sm-2" value="<?php echo $id?$unit['config_key']:'';?>" />
			<div class="help-block"> &nbsp;即配置的英文字符标识值，端上即以此标识拿到配置值，新增后尽量不要修改。</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置项名称：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" name="config_name" class="col-xs-10 col-sm-4" value="<?php echo $id?$unit['config_name']:'';?>" />
			<div class="help-block"> &nbsp;即配置的中文说明：例如“零钱与金币的汇率值”</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置项辅助说明：</label>
        <div class="col-sm-9">
            <div class="clearfix">
                <input type="text" id="form-field-1" name="config_help" class="col-xs-10 col-sm-8" value="<?php echo $id?$unit['config_help']:'';?>" />
            </div>
            <div class="space-1"></div>
            <div class="help-block">具体进入到各端各机型配置界面进行配置时，此项将会用于对配置管理员进行提示。</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">此配置项的排序值：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" name="sortnum" class="col-xs-10 col-sm-1" value="<?php echo $id?$unit['sortnum']:'';?>" />
			<div class="help-block"> &nbsp;值越大，在配置界面显示的时候越靠前。</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-2">配置项展现形式：</label>
        <div class="col-sm-9">
            <select name="config_htmltype" class="col-xs-10 col-sm-2" id="form-field-select-1">
                <?php foreach($platSet['htmltype'] as $value => $show){?>
                    <option value="<?php echo $value;?>" <?php if($id && $value == $unit['config_htmltype']) echo 'selected';?>><?php echo $show;?></option>
                <?php }?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">值列表：</label>
        <div class="col-sm-9">
            <div class="clearfix">
                <input type="text" id="form-field-1" name="config_htmlvalue" class="col-xs-10 col-sm-8" value="<?php echo $id?$unit['config_htmlvalue']:'';?>" />
            </div>
            <div class="space-1"></div>
            <div class="help-block">此项只针对上方选择单选框、复选框有用；格式(0:关闭|1:开启)，设置后即可呈现一个单选按钮或多选框</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置项输入框大小：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" name="config_widthheight" class="col-xs-10 col-sm-1" value="<?php echo $id?$unit['config_widthheight']:'';?>" />
			<div class="help-block"> &nbsp;只针对展现形式为文本框/域时设置的文本框长度。请输入一个1-9的数字即可。</div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置项默认值：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" name="config_value" class="col-xs-10 col-sm-4" value="<?php echo $id?$unit['config_value']:'';?>" />
			<div class="help-block"> &nbsp;各机型如果未进行独立配置，就会应用此配置项的默认值。</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">是否启用：</label>
        <div class="col-sm-9">
            <label>
                <input name="config_disable" value="0" type="radio" class="ace" <?php if($id && !$unit['config_disable']) echo 'checked="checked"';?> >
                <span class="lbl"> 禁用</span>
                &nbsp;
                <input name="config_disable" value="1" type="radio" class="ace" <?php if(!$id || $unit['config_disable']) echo 'checked="checked"';?>>
                <span class="lbl"> 启用</span>
            </label>
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
