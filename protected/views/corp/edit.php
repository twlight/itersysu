<?php
$company = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
$this->pageTitle=Yii::app()->name . ' - '.$company->CompanyName;
$this->breadcrumbs=array(
	$company->CompanyName,
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>完善企业信息</p>
		</div>
	</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'corpEdit-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'CompanyName'); ?>
		<?php echo $form->textField($model,'CompanyName'); ?>
		<?php echo $form->error($model,'CompanyName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StartYear'); ?>
		<?php echo $form->textField($model,'StartYear'); ?>
		<?php echo $form->error($model,'StartYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RegisteredCapital'); ?>
		<div class="input-append">
			<?php echo $form->textField($model,'RegisteredCapital',array('style'=>'margin:0px')); ?>
			<span class="add-on">万元</span>
		</div>
		<?php echo $form->error($model,'RegisteredCapital'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Scope'); ?>
		<?php echo $form->dropDownList($model,'Scope',Info::getScopeByArray()); ?>
		<?php echo $form->error($model,'Scope'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->dropDownList($model,'Type',Info::getCompanyTypeByArray()); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BusinessTypeId'); ?>
		<?php
			$arr = array();
			$bt = BusinessType::model()->findAll('ParentId=0');
			foreach($bt as $item){
				$tmp = array();
				$subbt = BusinessType::model()->findAll('ParentId=:Id',array(':Id'=>$item->Id));
				foreach($subbt as $it){
					$tmp[$it->Id] = $it->Name;
				}
				$arr[$item->Name] = $tmp;
			}
		?>
		<?php echo $form->dropDownList($model,'BusinessTypeId',$arr); ?>
		<?php echo $form->error($model,'BusinessTypeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Url'); ?>
		<?php echo $form->textField($model,'Url'); ?>
		<?php echo $form->error($model,'Url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PlaceId'); ?>
		<?php
			$arr = array();
			$p = Place::model()->findAll('ParentId=0');
			foreach($p as $item){
				$tmp = array();
				$subp = Place::model()->findAll('ParentId=:Id',array(':Id'=>$item->Id));
				foreach($subp as $it){
					$tmp[$it->Id] = $it->Name;
				}
				$arr[$item->Name] = $tmp;
			}
		?>
		<?php echo $form->dropDownList($model,'PlaceId',$arr); ?>
		<?php echo $form->error($model,'PlaceId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Img'); ?>
		<?php echo $form->textField($model,'Img'); ?>
		<?php echo $form->error($model,'Img'); ?>
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
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address'); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Introduction'); ?>
		<?php echo $form->textArea($model,'Introduction'); ?>
		<?php echo $form->error($model,'Introduction'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
