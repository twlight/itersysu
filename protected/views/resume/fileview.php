<?php
$this->pageTitle=Yii::app()->name . ' - 查看文件简历';
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
			<p>查看简历</p>
		</div>
	</div>

<?php if(!empty($model->Content)): ?>
<iframe src='<?php echo Yii::app()->user->UserType==0 ? Yii::app()->createUrl('resume/file',array('id'=>$model->Id)) : Yii::app()->createUrl('resume/adminfile',array('sid'=>$sid)); ?>' id='frame' style='width:100%' scrolling='auto'>
</iframe>
<?php else: ?>
<h2>文件处理失败！</h2>
<?php endif ?>
<?php
	Yii::app()->clientScript->registerScript('js','
		$("#frame").load(function(){
			var thisheight = $(this).contents().find("body").height()+30;
			$(this).height(thisheight < 500 ? 500 : thisheight);
		});
	',CClientScript::POS_READY);
?>
</div>
