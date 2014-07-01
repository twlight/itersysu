<?php
$this->pageTitle=Yii::app()->name . ' - 更改密码';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'更改密码',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>更改用户密码</p>
		</div>
	</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepw-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password'); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password'); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat'); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('更改密码'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="modal hide fade" id='success'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>提示</h3>
	</div>
	<div class="modal-body">
		<p>密码更改成功！</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">关闭</a>
	</div>
</div>

<?php
	if($success){
		Yii::app()->clientScript->registerScript('modal', '
			$("#success").modal({
				backdrop:true,
				keyboard:true,
				show:true
			});
		', $position=CClientScript::POS_LOAD);
	}
?>
</div>
