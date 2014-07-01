<?php
$this->pageTitle=Yii::app()->name . ' - 登录';
$this->breadcrumbs=array(
	'登录',
);
?>

<div class="info-body">


			<div class='index-left'>
				<img src='<?php echo Yii::app()->request->baseUrl; ?>/images/index.jpg'/>
			</div>
	<?php
			echo CHtml::openTag('div',array('class'=>'form index-right','style'=>'margin-top:20px;'));
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>true,
				'htmlOptions'=>array(
					'autocomplete'=>'off',
				),
			));
			echo CHtml::tag('h4',array(),'登录');
			echo CHtml::openTag('div',array('class'=>'row'));
			echo $form->labelEx($model,'email');
			echo CHtml::openTag('div',array('class'=>'input-prepend'));
			echo CHtml::tag('span',array('class'=>'add-on'),'<i class="icon-envelope"></i>');
			echo $form->textField($model,'email',array('placeholder'=>'请输入注册邮箱'));
			echo CHtml::closeTag('div');
			echo $form->error($model,'email');
			echo CHtml::closeTag('div');
			echo CHtml::openTag('div',array('class'=>'row'));
			echo $form->labelEx($model,'password');
			echo CHtml::openTag('div',array('class'=>'input-prepend'));
			echo CHtml::tag('span',array('class'=>'add-on'),'<i class="icon-qrcode"></i>');
			echo $form->passwordField($model,'password',array('placeholder'=>'请输入密码'));
			echo CHtml::closeTag('div');
			echo $form->error($model,'password');
			echo CHtml::closeTag('div');
			echo CHtml::openTag('div',array('class'=>'row rememberMe'));
			echo $form->checkBox($model,'rememberMe');
			echo $form->label($model,'rememberMe');
			echo $form->error($model,'rememberMe');
			echo CHtml::closeTag('div');

			echo CHtml::openTag('div',array('class'=>'row submit'));
			echo CHtml::submitButton('登录');

			$this->endWidget();

			echo CHtml::openTag('div',array('style'=>'margin-top:20px;text-align:center;'));
			echo CHtml::openTag('div',array('class'=>'btn-group'));
			echo CHtml::link('求职用户注册',array('site/userReg'),array('class'=>'btn btn-primary'));
			echo CHtml::link('企业用户注册',array('site/comReg'),array('class'=>'btn btn-success'));
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');

		?>




<!--	<div class="com-user-box">
		<div class="titbox">
			<p>用户登录</p>
		</div>
	</div>

<div class="form">

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); */?>

	<p class="note"><span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php //echo $form->labelEx($model,'email'); ?>
		<?php //echo $form->textField($model,'email'); ?>
		<?php //echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'password'); ?>
		<?php //echo $form->passwordField($model,'password'); ?>
		<?php //echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php //echo CHtml::submitButton('登录'); ?>
	</div>

<?php //$this->endWidget(); ?>
</div><!-- form -->
-->
</div>
