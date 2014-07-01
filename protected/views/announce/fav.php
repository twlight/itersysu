<?php
$this->pageTitle=Yii::app()->name . ' - 宣讲会收藏';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'宣讲会收藏',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>宣讲会收藏</p>
		</div>
	</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'announcefav-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'header'=>'日期',
			'name'=>'Date',
		),
		array(
			'header'=>'时间',
			'name'=>'Time',
		),
		array(
			'header'=>'公司',
			'name'=>'CompanyName',
		),
		array(
			'header'=>'学校',
			'name'=>'School',
		),
		array(
			'header'=>'城市',
			'name'=>'City',
		),
		array(
			'header'=>'地点',
			'name'=>'Address',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'deleteButtonUrl'=>'Yii::app()->createUrl("announce/delete",array("id"=>$data["aid"]))',
		),
	),
)); ?>
</div>
