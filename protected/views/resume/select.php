<?php
$this->pageTitle=Yii::app()->name . ' - 新增简历';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'新增简历',
);
?>

<div style='text-align:center;'>
	<div class='btn-group'>
		<a href='<?php echo Yii::app()->createUrl('resume/add'); ?>' class='btn btn-large btn-primary'>新增普通简历</a>
		<a href='<?php echo Yii::app()->createUrl('resume/addbyfile'); ?>' class='btn btn-large btn-success'>新增文件简历</a>
	</div>
</div>
