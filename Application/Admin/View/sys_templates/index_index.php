<layout name="layout" />
<block name="content">
    <style type="text/css">
    .threed{
        color: #fafafa;
        letter-spacing: 0;
        text-shadow: 0px 1px 0px #999, 0px 2px 0px #888, 0px 3px 0px #777, 0px 4px 0px #666, 0px 5px 0px #555, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;
        font-size:70px;
        }
    </style>
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="icon-remove"></i>
        </button>
        <i class="icon-ok green"></i>
        欢迎进入
        <strong class="green">
            {$platSet['platname']}
            <small></small>
        </strong>
    </div>
    <div class="row">
        <div class="col-sm-12 infobox-container" style="height:400px;">
            <h1>欢迎使用<br /><br /><br />
                <div class="threed">{$platSet['platname']}</div>
            </h1>
        </div>
        <div class="vspace-sm"></div>
    </div>
</block>
