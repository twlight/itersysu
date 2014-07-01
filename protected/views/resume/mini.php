<?php
/* @var $this ResumeController */
/* @var $model Resume */

$this->pageTitle=Yii::app()->name . ' - 微简历';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'微简历',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>微简历</p>
		</div>
	</div>
	<p>创建和修改微简历只能通过手机客户端完成！</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resume-mini-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'header'=>'简历ID',
			'name'=>'rid',
		),
		array(
			'name'=>'Time',
			'header'=>'修改时间',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{delete}',
			'viewButtonUrl'=>'Yii::app()->createUrl("resume/view",array("id"=>$data["rid"]))',
			'deleteButtonUrl'=>'Yii::app()->createUrl("resume/delete",array("id"=>$data["rid"]))',
		),
	),
)); ?>
</div>
