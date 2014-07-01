<?php
$this->pageTitle=Yii::app()->name . ' - 查看简历';
if(Yii::app()->user->UserType == 0){
	$this->breadcrumbs=array(
		'个人中心'=>array('my/index'),
		'简历管理'=>array('resume/index'),
		'查看简历'.$resume->Id,
	);
}
else if(Yii::app()->user->UserType == 1){
	$this->breadcrumbs=array(
		'个人中心'=>array('my/index'),
		'简历管理'=>array('resume/admin'),
		'查看简历'.$resume->Id,
	);
}
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>查看简历 - <?php echo $resume->Id; ?></p>
		</div>
	</div>
	<?php echo $str; ?>
</div>
