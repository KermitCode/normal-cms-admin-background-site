<script src="{$baseUrl['imgUrl']}jquery_17min.js"></script>
<script type="text/javascript">

$(function () {
    // var str = $("#answer").text();
    // var regex = /<br\s*[\/]?>/gi;
    // $("#answer").text(str.replace(regex, "\n"));
});
</script>

<style>
    
.pre-text {
    white-space: pre-wrap;
    word-wrap: break-word;
    word-break: break-all;
}
</style>

<layout name="layout" />
<block name="content">

<form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">问题分类：</label>
        <div class="col-sm-8">
            <select name="cateid" class="col-xs-2 col-sm-2" id="form-field-select-1">
                <?php foreach($categories as $key=>$value){ ?>
                        <option value="<?php echo $key;?>" <?php if($id && $key==$unit['cateid']) echo 'selected';?>><?php echo $value;?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">状态：</label>
        <div class="col-sm-8">
            <select name="enabled" class="col-xs-2 col-sm-2" id="form-field-select-1">
                <option value="1" <?php if($id && 1==$unit['enabled']) echo 'selected';?>>启用</option>
                <option value="0" <?php if($id && 0==$unit['enabled']) echo 'selected';?>>禁用</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">排序值：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" placeholder="排序值" name="sortnum" class="col-xs-2 col-sm-2" value="<?php echo $id?$unit['sortnum']:'';?>" />
            <div class="help-block">&nbsp;排序值越小越靠前</div>
        </div>
        
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">问题描述：</label>
        <div class="col-sm-8">
            <input type="text" id="form-field-1" placeholder="问题描述" name="question" class="col-xs-2 col-sm-12" value="<?php echo $id?$unit['question']:'';?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">答案：</label>
        <div class="col-sm-8">
            <textarea rows="5" name="answer" id="answer" placeholder="答案" class="col-sm-8 pre-text" style="padding:5px;"><?php echo $unit['answer'];?></textarea>
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