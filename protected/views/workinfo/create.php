<?php
$this->pageTitle=Yii::app()->name . ' - 新增招聘';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'招聘管理'=>array('workinfo/admin'),
	'新增招聘',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>新增招聘</p>
		</div>
	</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workinfo-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'Hr'); ?>
		<?php echo $form->textField($model,'Hr'); ?>
		<?php echo $form->error($model,'Hr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email'); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tel'); ?>
		<?php echo $form->textField($model,'Tel'); ?>
		<?php echo $form->error($model,'Tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EndTime'); ?>
		<?php echo $form->textField($model,'EndTime'); ?>
		<?php echo $form->error($model,'EndTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Introduction'); ?>
		<?php echo $form->textArea($model,'Introduction'); ?>
		<?php echo $form->error($model,'Introduction'); ?>
	</div>

	<div class="row">
		<h5>职位选择</h5>
		<table class='table table-striped table-condensed table-hover'>
			<thead>
				<tr>
					<th>是否启用</th><th>职位名</th><th>招聘人数(0为招聘若干人)</th><th>招聘城市</th><th>工作类型</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($position as $item): ?>
				<tr>
					<td><input type='checkbox'/><input type='hidden' value='0' name='WorkinfoForm[Detail][Checked][]'/></td>
					<td><?php echo $item->WorkName; ?></td>
					<td><input type='text' name='WorkinfoForm[Detail][OfferNum][]'/></td>
					<td><input type='text' name='WorkinfoForm[Detail][ZhaoPin_Place][]'/></td>
					<td>
						<select name="WorkinfoForm[Detail][Type][]">
							<option value=""></option>
							<option value="0">全职</option>
							<option value="1">兼职</option>
							<option value="2">实习</option>
						</select>
					</td>
				</tr>
				<?php endforeach ?>
				<?php if(count($position)==0): ?>
				<tr>
					<td colspan='5' style='text-align:center;'>您尚未添加职位，<?php echo CHtml::link('点击添加',array('position/create')); ?>!</td>
				</tr>
				<?php endif ?>
			</tbody>
		</table>
		<?php echo $form->error($model,'Detail'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
	Yii::app()->clientScript->registerScript('datepicker', '
		$("#WorkinfoForm_EndTime").datetimepicker({format: "yyyy-mm-dd hh:ii:ss",autoclose: true});
		$("input[type=\"checkbox\"]").click(function(){
			if($(this).is(":checked")){
				$(this).parent().children(":last").val(1);
			}
			else{
				$(this).parent().children(":last").val(0);
			}
		});
	',CClientScript::POS_LOAD);
?>
</div>
