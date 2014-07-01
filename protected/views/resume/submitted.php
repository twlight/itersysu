<?php
$this->pageTitle=Yii::app()->name . ' - 已投简历';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'简历管理'=>array('resume/index'),
	'已投简历',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>已投简历</p>
		</div>
	</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resume-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'class'=>'CLinkColumn',
			'header'=>'职位名称',
			'labelExpression'=>'$data["WorkName"]',
			'urlExpression'=>'Yii::app()->createUrl("workinfo/detail",array("id"=>$data["WorkinfoDetailId"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'公司名称',
			'labelExpression'=>'$data["CompanyName"]',
			'urlExpression'=>'Yii::app()->createUrl("workinfo/index",array("id"=>$data["WorkinfoId"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'简历名称',
			'labelExpression'=>'$data["ResumeName"]',
			'urlExpression'=>'Yii::app()->createUrl("resume/view",array("id"=>$data["ResumeId"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
		),
		array(
			'name'=>'Time',
			'header'=>'投递时间',
		),
	),
)); ?>
</div>
