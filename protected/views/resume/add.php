<?php
$this->pageTitle=Yii::app()->name . ' - 新增简历';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'简历管理'=>array('resume/index'),
	'新增简历',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>新增简历</p>
		</div>
	</div>
<?php if($id != null): ?>
<p class='resume-road'><a href='<?php echo Yii::app()->createUrl('resume/add',array('step'=>0,'id'=>$id)); ?>' class='<?php echo $step == 0 ? 'active' : 'normal'; ?>'>基本信息</a>--><a href='<?php echo Yii::app()->createUrl('resume/add',array('step'=>1,'id'=>$id)); ?>' class='<?php echo $step == 1 ? 'active' : 'normal'; ?>'>教育信息</a>--><a href='<?php echo Yii::app()->createUrl('resume/add',array('step'=>2,'id'=>$id)); ?>' class='<?php echo $step == 2 ? 'active' : 'normal'; ?>'>项目信息</a>--><a href='<?php echo Yii::app()->createUrl('resume/add',array('step'=>3,'id'=>$id)); ?>' class='<?php echo $step == 3 ? 'active' : 'normal'; ?>'>工作信息</a>--><a href='<?php echo Yii::app()->createUrl('resume/add',array('step'=>4,'id'=>$id)); ?>' class='<?php echo $step == 4 ? 'active' : 'normal'; ?>'>个人照片</a>--><a href='#' class='normal'>完成</a></p>
<?php else: ?>
<p class='resume-road'><a href='#' class='active'>基本信息</a>--><a href='#' class='normal'>教育信息</a>--><a href='#' class='normal'>项目信息</a>--><a href='#' class='normal'>工作信息</a>--><a href='#' class='normal'>个人照片</a>--><a href='#' class='normal'>完成</a></p>
<?php endif ?>

<?php
	if($step == 0){
		$this->renderPartial('_base', array('model'=>$model));
	}
	else if($step == 1){
		$this->renderPartial('_edu', array('model'=>$model));
	}
	else if($step == 2){
		$this->renderPartial('_pro', array('model'=>$model));
	}
	else if($step == 3){
		$this->renderPartial('_exp', array('model'=>$model));
	}
	else if($step == 4){
		$this->renderPartial('_pic', array('model'=>$model));
	}
?>
</div>
