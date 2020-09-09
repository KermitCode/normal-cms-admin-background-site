<layout name="layout" />
<block name="content">
<form class="form-horizontal" role="form" method="post" action="">

    <h5>&nbsp;&nbsp;<b>权限列表</b>：<span class="small">当前您正在修改管理员：(<span style="color:red;font-weight:bolder"><?php echo $adminer['username'];?></span>) 的权限</span>  <small>&nbsp;&nbsp;注：欢迎界面和管理员修改密码权限是必有权限,会自动加上。</small></h5> 
    <div class="col-sm-12" style="background-color:#fff;">
        <?php foreach($platSet['platMenu'] as $key=>$rightRow){ ?>
        <div class="panel-body" style="padding-top:10px;padding-bottom:0px;">
            <div style="border-bottom:1px solid #ddd;padding-bottom:5px;">
                <div style="float:left;width:10%;"><?php echo $rightRow['name']; ?>：</div>
                <div style="width:90%;float:left;border-left:1px solid #ddd;word-wrap: break-word;line-height:25px;">
                <?php if(isset($rightRow['child']) && $rightRow['child']){
					//班课报名功能单独列
					if($key=='signup'){?>
					<span style="display:inline-block;width:175px;margin-left:10px;">
						<input type="checkbox" name="<?php echo $key.'/close';?>" value="1" <?php echo in_array($key.'/close', $ad_right)?'checked="checked"':'';?> > 班课班名全流程
					</span>
				<?php }else{
						foreach($rightRow['child'] as $skey=>$srow){?>
							<span style="display:inline-block;width:175px;margin-left:10px;">
							   <input type="checkbox" name="<?php echo $key.'/'.$skey;?>" value="1" <?php echo in_array($key.'/'.$skey, $ad_right)?'checked="checked"':'';?> > <?php echo $srow['name'];?>
							</span>
						<?php }
					 }
				}else{?>
                        <span style="display:inline-block;width:175px;margin-left:10px;">
                           <input type="checkbox" name="<?php echo $key.'/index';?>" value="1" <?php echo in_array($key.'/index', $ad_right)?'checked="checked"':'';?> > <?php echo $rightRow['name'];?>
                        </span>
                    
                <?php }?>
                </div>
                <div style="clear:left;"></div>
            </div>
        </div>
        <?php }?>
        <input type="hidden" name="thisId" value="{$adminer['id']}"/>
    </div>
    <div style="clear:both;"></div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交-<span class='info'>修改管理员权限</span>
            </button>
        </div>
    </div>
</form>
</block>