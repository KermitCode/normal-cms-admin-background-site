<layout name="layout" />
<block name="content">
<div class="">
    <div class="tabbable">
        <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <?php foreach($platSet['settgradetwo'] as $key=>$value) {?>
            <li class="<?php echo $key?'':'active';?>">
                <a data-toggle="tab" href="#<?php echo $value;?>"><?php echo ucfirst($platf).'-'.ucfirst($value).$platSet['gradetwoname'].'-配置';?></a>
            </li>
        <?php }?>
        </ul>

        <div class="tab-content" style="padding:0px;margin:0px;padding-top:10px;">
            <?php foreach($platSet['settgradetwo'] as $key=>$mtype) {?>
            <div id="<?php echo $mtype;?>" class="tab-pane <?php echo $key?'':'active';?>">
                <?php foreach($htmlArr[$mtype] as $row){  ?>
                <form class="form-horizontal" role="form" method="post" action="">
                    <input type="hidden" name="form_id" value="<?php echo $platf.'_'.$mtype.'_'.$row['settype_id'].'_'.$row['id'];?>">
                    <div class="col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4><?php echo $row['setname']."<small> (".ucfirst($mtype)."机型)</small>"; ?></h4>
                                <span class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                        <i class="icon-chevron-up"></i>
                                    </a>
                                </span>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <?php echo $row['sethtml']; ?> 
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-xs">点击保存上方-<?php 
                                        echo ucfirst($mtype).'机型-'.$row['setname'].''?></button>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
            <?php }?>
            <div style="clear:both;"></div>
        </div>
    </div>
</div>



</block>
