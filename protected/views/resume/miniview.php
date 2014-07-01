<?php
$this->pageTitle=Yii::app()->name . ' - 查看微简历';
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
			<p>查看微简历 - <?php echo $resume->Id; ?></p>
		</div>
	</div>

	<h4>简历ID：<?php echo $resume->Id; ?></h4>
	<h4>姓名：<?php echo $model->Username; ?></h4>
	<h4>出生年月：<?php echo $model->Birth; ?></h4>
	<h4>性别：<?php echo Info::getSex($model->Sex); ?></h4>
	<h4>学历：<?php echo Info::getEdu_User($model->Edu); ?></h4>
	<h4>联系电话：<?php echo $model->Tel; ?></h4>
	<h4>Email：<?php echo $model->Email; ?></h4>
	<h4>个人简介：<?php echo $model->Introduction; ?></h4>
</div>
