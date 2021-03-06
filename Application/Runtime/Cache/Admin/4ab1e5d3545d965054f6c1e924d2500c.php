<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"><head><title><?php echo ($platSet['platname']); ?></title><meta charset="utf-8" />
		<meta name="keywords" content="<?php echo ($platSet['platname']); ?>" />
		<meta name="description" content="<?php echo ($platSet['platname']); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="<?php echo ($baseUrl['imgUrl']); ?>css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/font-awesome-ie7.min.css" />
		<![endif]-->
		<!-- page specific plugin styles -->
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/ace-skins.min.css" />
		<!-- 自定义 -->
		<!-- <link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/jquery-ui-1.10.3.full.min.css" />-->
 		<link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/jquery-ui-1.11.4.css">
 		<link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>js/layer/2.1/skin/layer.css" />
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/ace-ie.min.css" />
		<![endif]-->
        <link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/daterangepicker.css" />
		<!-- inline styles related to this page -->
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/ace-extra.min.js"></script>
		<!--[if lt IE 9]>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/html5shiv.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/respond.min.js"></script>
		<![endif]-->


	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							<?php echo ($platSet['platname']); ?>
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo ($baseUrl['imgUrl']); ?>avatars/avatar2.png" />
								<span style="width:200px;font-size:14px;">
									欢迎：<span style="color:yellow;font-weight:bolder;"><?php echo ($session['realName']); ?>(<?php echo ($session['userName']); ?>)</span>
								</span>
								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo U('/Admin/adminer/mypass');?>">
										<i class="icon-user"></i>
										修改账号密码
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo U('/Admin/login/loginout');?>">
										<i class="icon-off"></i>
										退出系统
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
					<!--菜单-->
                        <?php  $i=1; $adminRight = $session['userRight']; if($adminRight != 'all') { $adminRight = array_flip(explode('|', $adminRight)); } foreach($platSet['platMenu'] as $controler=>$row) { $isHave = false; if(!isset($row['child'])) { $con="/Admin/".$controler."/index"; if(is_string($adminRight) && $adminRight == 'all') $isHave = true; elseif(isset($adminRight[$controler.'/index'])) { $isHave = true; } }else{ $con=''; $haveopenchild = false; foreach($row['child'] as $key=>$name) { if(!$name['hidden']) $haveopenchild=true; if(is_string($adminRight) && $adminRight == 'all') $isHave = true; elseif(isset($adminRight[$controler.'/'.$key])) { $isHave = true; break; } } if(!$haveopenchild) $con="/Admin/".$controler."/index"; } if(!$isHave) continue; $ucon = $con?U($con):'javascript:;'; $conName = strtolower(CONTROLLER_NAME); $actName = strtolower(ACTION_NAME); ?>
							<li class="<?php echo $conName == $controler?'active':'';?>">
								<a href="<?php echo ($ucon); ?>" <?php echo $con?'':'class="dropdown-toggle"';?>>
									<i class="<?php echo $row['icon'];?>"></i> 
									<span class="menu-text"><?php echo $row['name'];?></span>
									<?php if(!$con){?><b class="arrow icon-angle-down"></b><?php }?>
								</a>
								<?php if(!$con){ ?>
									<ul class="submenu">
										<?php  foreach($row['child'] as $key=>$name) { if($name['hidden']) continue; if($adminRight!='all' && !isset($adminRight[$controler.'/'.$key])) continue; if(isset($realActionName) && !empty($realActionName)) { $actionName = $realActionName; } ?>
										<li <?php if($actName == $key && $conName == $controler) echo 'class="active"';?> >	
											<a href="<?php echo !$name['url']?U("/Admin/$controler/$key"):$name['url']; ?>" <?php if($name['url']) echo 'target="_blank"';?> >
												<i class="icon-double-angle-right"></i>
												<?php echo $name['name']; ?>
											</a>
										</li>
										<?php } ?>
									</ul>
								<?php }?>
						</li>
						<?php $i++;}?>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
                            <?php  $i=0; $num = count($platSet['breadCrumbs']); foreach($platSet['breadCrumbs'] as $name=>$url) { $icon = $i==0?"<i class='icon-home home-icon'></i>":''; if($url=='#') echo "<li class='active'>$name</li>"; else echo "<li>$icon<a href='$url'>$name</a></li>"; $i++; } ?>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							当前管理员角色：<strong><?php echo ($params['role'][$userRole]); ?></strong>&nbsp;&nbsp;当前IP：<strong><font color="red"><?php echo ($baseUrl['userIp']); ?></font></strong>
						</div><!-- #nav-search -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								<?php $temp = array_reverse($platSet['breadCrumbs']);echo key($temp);?>
								<small>
									<i class="icon-double-angle-right"></i>
									<?php echo key($temp);?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS 正式页面内容-->
								

<form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">菜单名称：</label>
        <div class="col-sm-8">
            <input type="text" name="showname" class="col-sm-3" value="<?php echo $id?$unit['showname']:'';?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">菜单所属级别：</label>
        <div class="col-sm-8">
            <select name="fatherid" class="col-xs-2 col-sm-3" >
                <?php foreach($fathermenu as $key=>$value){ ?>
                        <option value="<?php echo $key;?>" <?php if($id && $key==$unit['fatherid']) echo 'selected';?>><?php echo $value;?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">调用控制器/方法：</label>
        <div class="col-sm-8">
            <input type="text" name="keychar" class="col-sm-2" value="<?php echo $id?$unit['keychar']:'';?>" />
            <div class="help-block">&nbsp;顶级目录写控制器名称，其它项写方法名。比如调用MenuController只写menu即可</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">是否在菜单中隐藏：</label>
        <div class="col-sm-9">
            <label>
                <input name="hidden" value="0" type="radio" class="ace" <?php if(!$id || !$unit['hidden']) echo 'checked="checked"';?> >
                <span class="lbl"> 显示</span>
                &nbsp;
                <input name="hidden" value="1" type="radio" class="ace" <?php if($id && $unit['hidden']) echo 'checked="checked"';?>>
                <span class="lbl"> 隐藏</span>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">排序值：</label>
        <div class="col-sm-8">
            <input type="text" name="sortnum" class="col-sm-1" value="<?php echo $id?$unit['sortnum']:'';?>" />
            <div class="help-block">&nbsp;排序值越小越靠前</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 no-padding-right control-label">顶级菜单图标：</label>
        <div class="col-sm-2">
            <div class="input-group">
                 <input type="text" name="icon" value="<?php echo $id?$unit['icon']:''; ?>" class="form-control" placeholder="示例:icon-">
                 <span class="input-group-addon"><i class="<?php echo $id?$unit['icon']:''; ?>"></i></span>
            </div>
        </div>
        <div class="help-block">&nbsp;只有顶级菜单需要填写，其它不用填。<a href="http://www.runoob.com/bootstrap/bootstrap-glyphicons.html" target="_blank">点击查看可用图标列表</a></div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">直接跳转URL：</label>
        <div class="col-sm-8">
            <input type="text" name="fixurl" class="col-sm-6" placeholder="http://www..." value="<?php echo $id?$unit['fixurl']:'';?>" />
            <div class="help-block">&nbsp;如此菜单跳转至URL，请输入完整URL,只对二级菜单有效.</div>
        </div>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                提交-<span class='info'><?php echo $id?'修改':'新增'?></span>
                <input type="hidden" value="<?php echo ($id); ?>" name="id" >
            </button>
        </div>
    </div>
</form>

 
								<!-- PAGE CONTENT ENDS 正式页面内容-->

                                <div style="margin:30px 0 10px 0;line-height:25px;text-align:center;">
                                <hr>
                                <?php echo ($platSet['compname']); ?> | &COPY;<?php echo ($platSet['copyright']); ?>
                                </div>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; 选择皮肤</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl">切换到左边</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								切换窄屏
								<b></b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
        
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo ($baseUrl['imgUrl']); ?>js/jquery-2.0.3.min.js'>"+"<"+"script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='<?php echo ($baseUrl['imgUrl']); ?>js/jquery-1.10.2.min.js'>"+"<"+"script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo ($baseUrl['imgUrl']); ?>js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
          <script src="{{asset('assets/assets_admin/js/excanvas.min.js"></script>
		<![endif]-->

        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/jquery.slimscroll.min.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/jquery.easy-pie-chart.min.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/jquery.sparkline.min.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/flot/jquery.flot.min.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/flot/jquery.flot.time.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/flot/jquery.flot.pie.min.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/flot/jquery.flot.resize.min.js"></script>
        <!-- ace scripts -->
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/ace-elements.min.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/ace.min.js"></script>
        
        <!-- new add -->
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/validform/5.3.2/Validform.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/sys/sys.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/jquery-ui-1.11.4.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/highcharts/highcharts-4.2.5.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/layer/2.1/layer.js"></script>

        <!-- datatime -->
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/date-time/daterangepicker.min.js"></script>
        <script src="<?php echo ($baseUrl['imgUrl']); ?>js/date-time/moment.min.js"></script>
</body>
</html>