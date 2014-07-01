<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/application.css" />
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/script/rotatePics.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="top">
	<div class="container">
		<div class="top-left">
			<a target="_blank" href="#">下载手机版</a>
		</div>
		
		<div class="top-right">
			<ul>
				<?php if(Yii::app()->user->isGuest): ?>
				<li><a target="_blank" href="<?php echo Yii::app()->createUrl('site/userReg'); ?>">求职用户注册</a></li>
				<li>/</li>
				<li><a target="_blank" href="<?php echo Yii::app()->createUrl('site/comReg'); ?>">企业用户注册</a></li>
				<li>/</li>
				<li><a target="_blank" href="<?php echo Yii::app()->createUrl('site/login'); ?>">登录</a></li>
				<?php else: ?>
				<li>欢迎您，<a href='<?php echo Yii::app()->createUrl('my/index'); ?>'><?php echo Yii::app()->user->Username; ?></a></li>
				<?php endif ?>
			</ul>
		</div>
	</div>
	<div class='clear'></div>
</div>

<div id="header">
	<div class="container">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<div class="search-main">
			<div class="search-form">
				<form action='index.php' method='get'>
					<input type='hidden' name='r' value='job/search'/>
					<input type="text" id="search-text" autocomplete="off" name='key' placeholder='请输入关键字'/>
					<input type="submit" value="职位搜索" class="search-button"  style='width:78px;'/>
				</form>
			</div>
		</div>
	</div>
</div><!-- header -->

<div id="mainmenu">
	<div class='container'>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('site/index')),
				array('label'=>'职位搜索', 'url'=>array('job/search')),
				array('label'=>'宣讲会', 'url'=>array('announce/index')),
				array('label'=>'职场资讯', 'url'=>array('news/index')),
				array('label'=>'面试经历', 'url'=>array('share/index')),
				array('label'=>'个人中心', 'url'=>array('my/index')),
				array('label'=>'退出 ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div>
	<div class="clear"></div>
</div><!-- mainmenu -->

<div class="container" id="page">

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

</div><!-- page -->

<div id="footer">
	<a href='#'>网站地图</a> &nbsp;| &nbsp; <a href='#'>版本说明</a> &nbsp; | &nbsp; <a href='#'>关于我们</a> &nbsp; | &nbsp; <a href='mailto:zhyaof@vip.qq.com'>联系我们</a>
	<br/>
	Copyright &copy; <?php echo date('Y'); ?> by Lemon. All Rights Reserved.
</div><!-- footer -->
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/jquery-ui.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/jquery.cookie.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/jquery.contextmenu.r2.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/jquery.json-2.4.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-alert.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-modal.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-dropdown.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-scrollspy.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-tab.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-tooltip.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-popover.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-button.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-collapse.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-carousel.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-typeahead.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap-transition.js"></script>
<script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

</body>
</html>
