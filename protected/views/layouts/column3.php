<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div class="span9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class='span2'>
		<?php if(Yii::app()->user->UserType == 0): ?>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">简历管理</div>
				</div>
				<div class="menu_btop">
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('resume/select'); ?>">新增简历</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('resume/index'); ?>">简历管理</a></li>
						<!--<li><a href="<?php echo Yii::app()->createUrl('resume/mini'); ?>">微简历</a></li>-->
					</ul>
				</div>
			</div>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">求职管理</div>
				</div>
				<div class="menu_btop">
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('favourite/index'); ?>">职位收藏夹</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('resume/submitted'); ?>">已投简历</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('announce/fav'); ?>">宣讲会收藏</a></li>
					</ul>
				</div>
			</div>
		<?php else: ?>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">职位模板</div>
				</div>
				<div class="menu_btop">
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('position/create'); ?>" class="corp">新增职位</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('position/index'); ?>" class="corp">职位管理</a></li>
					</ul>
				</div>
			</div>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">招聘管理</div>
				</div>
				<div class="menu_btop">
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('workinfo/create'); ?>" class="corp">新增招聘</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('workinfo/admin'); ?>" class="corp">招聘管理</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('resume/admin'); ?>" class="corp">简历管理</a></li>
					</ul>
				</div>
			</div>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">人才库</div>
				</div>
				<div class="menu_btop">
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('#'); ?>" class="corp">人才库</a></li>
					</ul>
				</div>
			</div>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">宣讲会管理</div>
				</div>
				<div class="menu_btop">
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('announce/create'); ?>" class="corp">发布宣讲会</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('announce/admin'); ?>" class="corp">宣讲会管理</a></li>
					</ul>
				</div>
			</div>
			<div class="menu_box">
				<div class="menu_bg">
					<div class="menu_tit">信息管理</div>
				</div>
				<div class="menu_btop">
					<ul>
					<?php $company = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
					if(empty($company->StartYear) || empty($company->RegisteredCapital)):?>
						<li><a href="<?php echo Yii::app()->createUrl('corp/edit'); ?>">企业信息</a></li>
					<?php else: ?>
						<li><a href="<?php echo Yii::app()->createUrl('corp/view'); ?>">企业信息</a></li>
					<?php endif ?>	
					</ul>
				</div>
			</div>
		<?php endif ?>
		<div class="menu_box">
			<div class="menu_bg">
				<div class="menu_tit">个人信息</div>
			</div>
			<div class="menu_btop">
				<ul>
					<li><a href="<?php echo Yii::app()->createUrl('my/info'); ?>">账户信息</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('my/gravatar'); ?>">修改头像</a></li>
					<li><a href="#">站内消息</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('my/loginlog'); ?>">登陆日志</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('my/changepw'); ?>">密码修改</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">安全退出</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="modal hide fade" id="corpedit">
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>提示</h3>
	</div>
	<div class="modal-body">
		<p>您的企业信息尚未完善，请先完善企业信息！</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">关闭</a>
		<a href="<?php echo Yii::app()->createUrl('corp/edit'); ?>" class="btn btn-primary">完善信息</a>
	</div>
</div>

<?php
	if(!Yii::app()->user->isInfoCompe()){
		Yii::app()->clientScript->registerScript('js','
			$(document).on("click",".corp",function(){
				$("#corpedit").modal({
					backdrop:true,
					keyboard:true,
					show:true
				});
				return false;
			});
		',CClientScript::POS_LOAD);
	}
?>

<?php $this->endContent(); ?>
