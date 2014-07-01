<?php
$this->pageTitle=Yii::app()->name."- 职位管理";

$this->breadcrumbs=array(
	'职位管理'
);

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array("style"=>"width:560px;",'class'=>'detail-view'),
		'attributes'=>array(
			array(
				'name'=>'WorkName',
				'label'=>'职位名',
			),
			array(
				'name'=>'Edu',
				'label'=>'学历要求',
				'value'=>Info::getEdu_Corp($model->Edu),
			),
			array(
				'name'=>'Experience',
				'label'=>'经验要求',
				'value'=>Info::getExperience_Corp($model->Experience),
			),
			array(
				'name'=>'Sex',
				'label'=>'性别要求',
				'value'=>Info::getSex($model->Sex),
			),
			array(
				'name'=>'Age',
				'label'=>'年龄要求',
			),
			array(
				'name'=>'WorkPlace',
				'label'=>'工作地点',
			),
			array(
				'name'=>'Pay',
				'label'=>'工作',
				'value'=>$model->Pay == 0 ? "面议" : $model->Pay,
			),
			array(
				'name'=>'Introduction',
				'label'=>'职位简介',
			),
			array(
				'name'=>'Con',
				'label'=>'应聘条件',
			),
			array(
				'name'=>'Welfare',
				'label'=>'福利待遇',
			),
		),
	));
?>
