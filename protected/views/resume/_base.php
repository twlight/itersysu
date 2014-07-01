<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rbase-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name'); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Secret'); ?>
		<?php echo $form->radioButtonList($model,'Secret',array(0=>'保密',1=>'公开'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline;margin-right: 10px;'))); ?>
		<?php echo $form->error($model,'Secret'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'Username'); ?>
		<?php echo $form->error($model,'Username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Birth'); ?>
		<?php echo $form->textField($model,'Birth'); ?>
		<?php echo $form->error($model,'Birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Sex'); ?>
		<?php echo $form->radioButtonList($model,'Sex',array(1=>'男',2=>'女'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline;margin-right: 10px;'))); ?>
		<?php echo $form->error($model,'Sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Marrage'); ?>
		<?php echo $form->radioButtonList($model,'Marrage',array(0=>'未婚',1=>'已婚',2=>'保密'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline;margin-right: 10px;'))); ?>
		<?php echo $form->error($model,'Marrage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Hukou'); ?>
		<?php echo $form->textField($model,'Hukou'); ?>
		<?php echo $form->error($model,'Hukou'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address'); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Edu'); ?>
		<?php echo $form->dropDownList($model,'Edu',Info::getEdu_UserByArray()); ?>
		<?php echo $form->error($model,'Edu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Experience'); ?>
		<?php echo $form->dropDownList($model,'Experience',Info::getExperience_UserByArray()); ?>
		<?php echo $form->error($model,'Experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tel'); ?>
		<?php echo $form->textField($model,'Tel'); ?>
		<?php echo $form->error($model,'Tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email'); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'QQ'); ?>
		<?php echo $form->textField($model,'QQ'); ?>
		<?php echo $form->error($model,'QQ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Url'); ?>
		<?php echo $form->textField($model,'Url'); ?>
		<?php echo $form->error($model,'Url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Hobby'); ?>
		<?php echo $form->textArea($model,'Hobby'); ?>
		<?php echo $form->error($model,'Hobby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Awarded'); ?>
		<?php echo $form->textArea($model,'Awarded'); ?>
		<?php echo $form->error($model,'Awarded'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存并跳转下一步'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
	Yii::app()->clientScript->registerScript('datepicker', '
		$("#RBaseForm_Birth").datetimepicker({format: "yyyy-mm-dd",autoclose: true,minView:"2"});
	',CClientScript::POS_LOAD);
?>
