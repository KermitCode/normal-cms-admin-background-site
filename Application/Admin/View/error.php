<layout name="layout" />
<block name="content">
<div style="margin-bottom: 10px;">
    <div style="width:100%;height:100px;margin:100px auto;text-align:center;">
        <div style="width:500px;height:100px;border:1px solid #ccc;margin:0 auto;padding:20px;">
            发生错误：<span style="color:red;font-weight:bolder;">{$error}</span><br><br>
            您可以：<a href="{:U('/Admin/Index')}">进后台首页</a> &nbsp;
            <a href="javascript:history.go(-1);">返回上一页</a>
        </div>
    </div>
</div>
</block>