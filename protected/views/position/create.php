<?php
$this->pageTitle=Yii::app()->name . ' - 添加职位';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'职位管理'=>array('position/index'),
	'添加职位',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>添加职位</p>
		</div>
	</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'WorkName'); ?>
		<?php echo $form->textField($model,'WorkName'); ?>
		<?php echo $form->error($model,'WorkName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Edu'); ?>
		<?php echo $form->dropDownList($model,'Edu',Info::getEdu_CorpByArray()); ?>
		<?php echo $form->error($model,'Edu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Experience'); ?>
		<?php echo $form->dropDownList($model,'Experience',Info::getExperience_CorpByArray()); ?>
		<?php echo $form->error($model,'Experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Sex'); ?>
		<?php echo $form->dropDownList($model,'Sex',Info::getSexByArray()); ?>
		<?php echo $form->error($model,'Sex'); ?>
	</div>

	<div class="row">
		<?php $model->Age = '不限'; ?>
		<?php echo $form->labelEx($model,'Age'); ?>
		<?php echo $form->textField($model,'Age'); ?>
		<?php echo $form->error($model,'Age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WorkPlace'); ?>
		<?php echo $form->textField($model,'WorkPlace'); ?>
		<?php echo $form->error($model,'WorkPlace'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Pay'); ?>
		<div class="input-append">
			<?php echo $form->textField($model,'Pay',array('style'=>'margin:0px;')); ?>
			<span class="add-on">元</span>
		</div>
		<p>填0为面议。</p>
		<?php echo $form->error($model,'Pay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Introduction'); ?>
		<?php echo $form->textArea($model,'Introduction'); ?>
		<?php echo $form->error($model,'Introduction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Con'); ?>
		<?php echo $form->textArea($model,'Con'); ?>
		<?php echo $form->error($model,'Con'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Welfare'); ?>
		<?php echo $form->textArea($model,'Welfare'); ?>
		<?php echo $form->error($model,'Welfare'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
