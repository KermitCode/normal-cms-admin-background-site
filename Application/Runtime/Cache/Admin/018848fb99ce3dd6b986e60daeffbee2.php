<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($platSet['platname']); ?></title>
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
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo ($baseUrl['imgUrl']); ?>css/ace-ie.min.css" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/html5shiv.js"></script>
		<script src="<?php echo ($baseUrl['imgUrl']); ?>js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center" style="margin-top:100px;">
								<h1>
									<i class="icon-leaf green"></i>
									<span class="red"><?php echo ($platSet['platname']); ?></span>
								</h1>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												请输入管理员账号密码
											</h4>

											<div class="space-6"></div>

											<form action="" method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="admin_name" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="pwd" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="text" name="Code" class="width-25" />
                                                            <img src="<?php echo U('Admin/login/makecode');?>" style="vertical-align:middle;" id="imgcode" onclick="this.src='<?php echo U('Admin/login/makecode');?>?d='+Math.random();">
                                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                                <i class="icon-key"></i>
                                                                登 录
                                                            </button>
                                                        </label>
													</div>

													<div class="space-4"></div>
                                                    <div style="color:red;">
                                                    <?php echo ($message?$message:''); ?> 测试账号:test 123456
                                                    </div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110"></span>
											</div>
										</div><!-- /widget-main -->

										<div class="toolbar clearfix">
											<div style="width:98%;text-align:right;">
												<a class="forgot-password-link">
                                                    <?php echo ($platSet['compname']); ?> &copy;<?php echo ($platSet['copyright']); ?>
												</a>
											</div>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /login-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo ($baseUrl['imgUrl']); ?>js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo ($baseUrl['imgUrl']); ?>js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo ($baseUrl['imgUrl']); ?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>
</body>
</html>