<?php
$this->pageTitle=Yii::app()->name . ' - 分享面试经历';
$this->breadcrumbs=array(
	'面试经历'=>array('share/index'),
	'分享面试经历',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>分享面试经历</p>
		</div>
	</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shareaudition-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'CompanyName'); ?>
		<?php echo $form->textField($model,'CompanyName'); ?>
		<?php echo $form->error($model,'CompanyName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PostName'); ?>
		<?php echo $form->textField($model,'PostName'); ?>
		<?php echo $form->error($model,'PostName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Place'); ?>
		<?php echo $form->textField($model,'Place'); ?>
		<?php echo $form->error($model,'Place'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AuditionTime'); ?>
		<?php echo $form->textField($model,'AuditionTime'); ?>
		<?php echo $form->error($model,'AuditionTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CostTime'); ?>
		<div class='input-append'>
			<?php echo $form->textField($model,'CostTime',array('style'=>'margin:0px;')); ?>
			<span class="add-on">小时</span>
		</div>
		<?php echo $form->error($model,'CostTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Process'); ?>
		<?php echo $form->textArea($model,'Process'); ?>
		<?php echo $form->error($model,'Process'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Question'); ?>
		<?php echo $form->textArea($model,'Question'); ?>
		<?php echo $form->error($model,'Question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Way'); ?>
		<?php echo $form->dropDownList($model,'Way',array('社会招聘','校园招聘','其他')); ?>
		<?php echo $form->error($model,'Way'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Method'); ?>
		<?php echo $form->dropDownList($model,'Method',array('1对1面试','1对多面试','群面','其他')); ?>
		<?php echo $form->error($model,'Method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Difficulty'); ?>
		<?php echo $form->dropDownList($model,'Difficulty',array('简单','一般','稍难','难','很难')); ?>
		<?php echo $form->error($model,'Difficulty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Feel'); ?>
		<?php echo $form->dropDownList($model,'Feel',array('不好','一般','好','很好')); ?>
		<?php echo $form->error($model,'Feel'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
<?php
	Yii::app()->clientScript->registerScript('datepicker', '
		$("#ShareAuditionForm_AuditionTime").datetimepicker({format: "yyyy-mm-dd",autoclose: true,minView:"2"});
	',CClientScript::POS_LOAD);
?>
