<layout name="layout" />
<block name="content">
<form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">管理员登录账号：</label>
        <div class="col-sm-9">
            <input type="text" name="username" class="col-xs-10 col-sm-5" <?php echo $id?"value='".$unit['username']."'":'';?> />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">登录密码：</label>
        <div class="col-sm-6">
            <div class="clearfix">
                <input type="password" name="pass" class="col-xs-10 col-sm-5" value="" />
            </div>
            <div class="help-block">新增管理员时留空即为默认密码123456，修改管理员时留空则不修改密码。</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">管理员真实姓名：</label>
        <div class="col-sm-5">
            <div class="clearfix">
                <input class="col-xs-3" type="text" id="form-field-5" name="realname"  value="<?php echo $id?$unit['realname']:'';?>" />
            </div>
        </div>
    </div>
	<div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">管理员手机号：</label>
        <div class="col-sm-5">
            <div class="clearfix">
                <input class="col-xs-3" type="text" id="form-field-5" name="phone"  value="<?php echo $id?$unit['phone']:'';?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">管理员角色：</label>
        <div class="col-sm-8">
            <select name="role" class="col-xs-3 col-sm-3" id="form-field-select-1" <?php if($id && $userId != 1) echo 'disabled';?> >
                <?php foreach($params['role'] as $key=>$value){
                        ?>
                        <option value="{$key}" <?php if($id && $key==$unit['role']) echo 'selected';?>><?php echo strip_tags($value);?></option>
                <?php   
                      }?>
            </select>
			<div class="help-block"> &nbsp;平台只允许有一个超级管理员，不能新增超级管理员。</div>
        </div>
		
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">状态：</label>
        <div class="col-sm-9">
            <label>
                <input name="status" value="0" type="radio" class="ace" <?php if($id && !$unit['status']) echo 'checked="checked"';?> >
                <span class="lbl"> 禁用</span>
                &nbsp;
                <input name="status" value="1" type="radio" class="ace" <?php if(!$id || $unit['status']) echo 'checked="checked"';?>>
                <span class="lbl"> 启用</span>
            </label>
        </div>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交-<span class='info'><?php echo $id?'修改管理员':'新增管理员'?></span>
                <input type="hidden" value="{$id}" name="id" >
            </button>
        </div>
    </div>
</form>
</block>