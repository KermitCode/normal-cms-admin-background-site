<layout name="layout" />
<block name="content">
<form class="form-horizontal">
<div class="tabbable">
    <div class="tab-content profile-edit-tab-content">
        <div id="edit-basic" class="tab-pane active">
        <h4 class="header blue bolder smaller">基本信息</h4>

        <div class="row">
            <div class="col-xs-10 col-sm-10">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">用户id</label>
                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" placeholder="Username" value="{$unit.uid}" readonly="readonly">
                    </div>
                </div>
                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">用户名</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" placeholder="Username" value="{$unit.username}" readonly="readonly">
                    </div>
                </div>
                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">真实姓名</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.realname}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">手机号</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.phone}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">微信Openid</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.weixin_id}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">微信昵称</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.weixin_nickname}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">徒弟数量</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.tudi_num}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">邀请码</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.invitecode}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">创建时间</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.addtime|date="Y-m-d H:i:s",###}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">最后登录时间</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.lasttime|date="Y-m-d H:i:s",###}" readonly="readonly">
                    </div>
                </div>
                <div class="space"></div>
            </div>

            <div class="col-xs-2 col-sm-2">
                <img src="{$unit.userimg}" width="80px;" />
            </div>
        </div>

        
        <h4 class="header blue bolder smaller">金币及零钱信息</h4>
        <div class="row">
            <div class="col-xs-10 col-sm-10">

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">金币数量</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="{$unit.golds}" readonly="readonly">
                    </div>
                </div>
                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">现金(单位元)</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="<?php echo $unit['money']/100;?>" readonly="readonly">
                    </div>
                </div>
                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-left" for="form-field-date">累计提现(单位元)</label>

                    <div class="col-sm-8">
                        <input class="col-xs-12 col-sm-10" type="text" id="form-field-username" value="<?php echo $unit['out_cash']/100;?>" readonly="readonly">
                    </div>
                </div>
                <div class="space-4"></div>

            </div>
        </div>

       
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <a class="btn btn-info" href="/admin/user/index.html">
                返回
            </a>
        </div>
    </div>

</form>
</block>