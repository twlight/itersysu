<?php
$this->pageTitle=Yii::app()->name."- 职位管理";
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'职位管理',
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'position-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>true,
	'selectableRows'=>true,
	'columns'=>array(
		array(
			'name'=>'WorkName',
			'header'=>'职位名',
		),
		array(
			'name'=>'Edu',
			'header'=>'学历要求',
			'value'=>'Info::getEdu_Corp($data->Edu)',
			'filter'=>Info::getEdu_CorpByArray(),
		),
		array(
			'name'=>'Experience',
			'header'=>'经验要求',
			'value'=>'Info::getExperience_Corp($data->Experience)',
			'filter'=>Info::getExperience_CorpByArray(),
		),
		array(
			'name'=>'Sex',
			'header'=>'性别要求',
			'value'=>'Info::getSex($data->Sex)',
			'filter'=>Info::getSexByArray(),
		),
		array(
			'name'=>'Age',
			'header'=>'年龄要求',
		),
		array(
			'name'=>'WorkPlace',
			'header'=>'工作地点',
		),
		array(
			'name'=>'Pay',
			'header'=>'工资',
			'value'=>'$data->Pay == 0 ? "面议" : $data->Pay',
		),
		array(
			'class'=>'CButtonColumn',
			'updateButtonUrl'=>'Yii::app()->createUrl("position/create",array("id"=>$data->Id))',
		),
	),
)); ?>
