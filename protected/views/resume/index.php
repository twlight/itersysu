<?php
/* @var $this ResumeController */
/* @var $model Resume */

$this->pageTitle=Yii::app()->name . ' - 简历管理';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'简历管理',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>简历管理</p>
		</div>
	</div>
<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>警告: </strong>删除简历会同时删除已投递的简历！</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resume-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'header'=>'简历名称',
			'name'=>'Name',
		),
		array(
			'name'=>'Type',
			'header'=>'简历类型',
			'filter'=>array(
				'普通简历'=>'普通简历',
				'微简历'=>'微简历',
				'通过上传文件而生成的简历'=>'通过上传文件而生成的简历',
			),
		),
		array(
			'name'=>'Time',
			'header'=>'修改时间',
		),
		array(
			'header'=>'完成指数',
			'name'=>'Comp',
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'下载简历',
			'label'=>'点此下载',
			'urlExpression'=>'Yii::app()->createUrl("resume/download",array("id"=>$data["rid"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
			'headerHtmlOptions'=>array('style'=>'min-width: 55px;'),
		),
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl'=>'Yii::app()->createUrl("resume/view",array("id"=>$data["rid"]))',
			'updateButtonUrl'=>'$data["Type"] == "普通简历" ? Yii::app()->createUrl("resume/add",array("id"=>$data["rid"])) : Yii::app()->createUrl("resume/addbyfile",array("id"=>$data["rid"]))',
			'buttons'=>array(
				'update'=>array(
					'visible'=>'$data["Type"] != "微简历"',
				),
			),
			'deleteButtonUrl'=>'Yii::app()->createUrl("resume/delete",array("id"=>$data["rid"]))',
		),
	),
)); ?>
</div>
