<layout name="layout" />
<block name="content">
<form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">管理平台名称：</label>
        <div class="col-sm-8">
            <input type="text"  name="platname" class="col-sm-5" value="<?php echo $unit['platname'];?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">公司名称：</label>
        <div class="col-sm-8">
            <input type="text"  name="compname" class="col-sm-3" value="<?php echo $unit['compname'];?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">版权时间</label>
        <div class="col-sm-8">
            <input type="text"  name="copyright" class="col-sm-2" value="<?php echo $unit['copyright'];?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">登录启用动态码：</label>
        <div class="col-sm-9">
            <label>
                <input name="googlecheck" value="0" type="radio" class="ace" <?php if(!$unit['googlecheck']) echo 'checked="checked"';?> >
                <span class="lbl"> 不启用动态码</span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input name="googlecheck" value="1" type="radio" class="ace" <?php if($unit['googlecheck']) echo 'checked="checked"';?>>
                <span class="lbl"> 启用动态码</span>
			    <div class="help-block">如果启用动态码，后台登录输入密码时在设定密码后需再输入动态码.</div>
            </label>
        </div>
    </div>

    <hr>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">一级配置分类名称：</label>
        <div class="col-sm-8">
            <input type="text"  name="gradeonename" class="col-sm-4" value="<?php echo $id?$unit['gradeonename']:'';?>" />
			<div class="help-block"> &nbsp;此项作为下面这项的名称显示在新增/修改配置项的第一个里</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" >一级配置分类列表：</label>
        <div class="col-sm-9">
            <div class="clearfix">
                <input type="text"  name="settgradeone" class="col-sm-8" value="<?php echo $id?$unit['settgradeone']:'';?>" />
            </div>
            <div class="space-1"></div>
            <div class="help-block">如果配置不用再分就不用处理，如需要分安卓/IOS配置可填写android|ios</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">二级配置后缀列表：</label>
        <div class="col-sm-8">
            <input type="text"  name="gradetwoname" class="col-sm-4" value="<?php echo $id?$unit['gradetwoname']:'';?>" />
			<div class="help-block"> &nbsp;此项作为下面这项的名称显示在新增/修改配置项的第一个里</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">二级配置分类列表：</label>
        <div class="col-sm-8">
            <input type="text"  name="settgradetwo" class="col-sm-4" value="<?php echo $id?$unit['settgradetwo']:'';?>" />
			<div class="help-block"> &nbsp;此项将显示在上面分类下面的细项分类配置</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">配置项所属平台：</label>
        <div class="col-sm-8">
            <select name="platf" class="col-sm-2" id="form-field-select-1" <?php if($id) echo 'disabled';?> >
                <?php foreach($platSet['platf'] as $key=>$value){ ?>
                        <option value="<?php echo $value;?>" <?php if($id && $value==$unit['platf']) echo 'selected';?>><?php echo $value;?></option>
                <?php }?>
            </select>
			<div class="help-block"> &nbsp;所属平台新增后不允许随意修改。</div>
        </div>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                修改系统配置 
                <input type="hidden" value="{$id}" name="id" >
            </button>
        </div>
    </div>
</form>
</block>
