<layout name="layout" />
<block name="content">
<!-- 列表 -->
<style type="text/css">
.answer dt{font-size:16px;margin-top:8px;}
.answer dd{font-size:13px;line-height:28px;text-indent:24px;border-bottom:1px solid #eee;}
</style>
<div class="row-fluid answer">
    <dl style="line-height:24px;">
    <foreach name="data" item="row">
        <dt>{$row.question}</dt>
        <dd>{$row.answer}</dd>
    </foreach>
    </dl>
</div>
</block>
