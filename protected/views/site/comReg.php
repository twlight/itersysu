<?php
$this->pageTitle=Yii::app()->name . ' - 企业用户注册';
$this->breadcrumbs=array(
	'企业用户注册',
);
?>

<h1>企业用户注册</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comReg-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat'); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name'); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel'); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('注册'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
