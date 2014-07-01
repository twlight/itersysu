<?php
$this->pageTitle=Yii::app()->name . ' - 新增简历';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'新增简历',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>上传文件以生成简历</p>
		</div>
	</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>
	<?php if(!$new): ?>
	<div class="alert alert-error">
        <a class="close" data-dismiss="alert">×</a>
        <strong>上传文件以覆盖已上传文件：</strong><?php echo $filename; ?>
      </div>
	<?php endif ?>

	<div class="row">
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->textField($model,'filename'); ?>
		<?php echo $form->error($model,'filename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'Username'); ?>
		<?php echo $form->error($model,'Username'); ?>
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
		<?php echo $form->labelEx($model,'Sex'); ?>
		<?php echo $form->radioButtonList($model,'Sex',array(1=>'男',2=>'女'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline;margin-right: 10px;'))); ?>
		<?php echo $form->error($model,'Sex'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('上传'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
