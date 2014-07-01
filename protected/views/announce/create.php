<?php
$this->pageTitle=Yii::app()->name . ' - 添加宣讲会';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'宣讲会管理'=>array('announce/admin'),
	'发布宣讲会',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>发布宣讲会</p>
		</div>
	</div>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'acreate-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->textField($model,'City'); ?>
		<?php echo $form->error($model,'City'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'School'); ?>
		<?php echo $form->textField($model,'School'); ?>
		<?php echo $form->error($model,'School'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Date'); ?>
		<?php echo $form->textField($model,'Date'); ?>
		<?php echo $form->error($model,'Date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StartTime'); ?>
		<?php echo $form->textField($model,'StartTime'); ?>
		<?php echo $form->error($model,'StartTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EndTime'); ?>
		<?php echo $form->textField($model,'EndTime'); ?>
		<?php echo $form->error($model,'EndTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textArea($model,'Address'); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Remark'); ?>
		<?php echo $form->textArea($model,'Remark'); ?>
		<?php echo $form->error($model,'Remark'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('发布'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<?php
	Yii::app()->clientScript->registerScript('js','
		$("#AnnounceForm_Date").datetimepicker({format: "yyyy-mm-dd",minView:2});
	',CClientScript::POS_LOAD);
?>
</div>
