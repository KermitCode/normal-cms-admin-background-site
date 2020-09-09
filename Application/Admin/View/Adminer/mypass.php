<layout name="layout" />
<block name="content">
<form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">当前修改的管理员账号：</label>
        <div class="col-sm-2">
            <input type="text" class="col-xs-10 col-sm-5" value="<?php echo $userName;?>"  disabled />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">原登录密码：</label>
        <div class="col-sm-6">
            <div class="clearfix">
                <input type="password" name="pass" class="col-xs-10 col-sm-5" value="" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">新密码：</label>
        <div class="col-sm-6">
            <div class="clearfix">
                <input type="password" name="pass1" class="col-xs-10 col-sm-5" value="" />
            </div>
			<div class="help-block">密码长度必须6位或6以上，更改密码后请重新登录。</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right">重复新密码：</label>
        <div class="col-sm-6">
            <div class="clearfix">
                <input type="password" name="pass2" class="col-xs-10 col-sm-5" value="" />
            </div>
        </div>
    </div>
    

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交-<span class='info'>密码修改</span>
            </button>
        </div>
    </div>
</form>
</block>