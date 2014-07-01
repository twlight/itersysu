<?php
$this->pageTitle=Yii::app()->name . ' - 个人中心';
$this->breadcrumbs=array(
	'个人中心',
);
?>

<?php
	$email = Yii::app()->user->Email;
	$size = 100;
	$default = 'http://'.$_SERVER["SERVER_ADDR"].Yii::app()->request->baseUrl.'/images/no_photo.gif';
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="user-photo">
			<!--<img src="./images/no_photo.gif" border="0"/>-->
			<img src="<?php echo $grav_url; ?>" border="0"/>	
		</div>
		<div class="user-info">
			<?php if(Yii::app()->user->UserType == 0): ?>
			<h2><?php echo Yii::app()->user->Username; ?></h2>
			<h4><?php echo Yii::app()->user->Email; ?></h4>
			<?php else: ?>	
			<h2><?php echo Company::model()->find('UserId=:Id',array(':Id'=>Yii::app()->user->UserId))->CompanyName; ?></h2>
			<h4><?php echo Yii::app()->user->Email; ?></h4>
			<?php endif ?>
		</div>
		<div class="user-button-box">
		<?php if(Yii::app()->user->UserType == 0): ?>
			<a href="<?php echo Yii::app()->createUrl('resume/select'); ?>">
				<div class="resume-button">
					创建简历
				</div>
			</a>
			<a href="<?php echo Yii::app()->createUrl('resume/index'); ?>">
				<div class="resume-button">
					管理简历
				</div>
			</a>
		<?php else: ?>	
			<a href="<?php echo Yii::app()->createUrl('workinfo/create'); ?>" class="corp">
				<div class="resume-button">
					新增招聘
				</div>
			</a>
			<a href="<?php echo Yii::app()->createUrl('workinfo/admin'); ?>" class="corp">
				<div class="resume-button">
					招聘管理
				</div>
			</a>
		<?php endif ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="com-user-box">
		<div class="titbox">
			<p>最新招聘职位</p>
		</div>
		<?php
			$info = Workinfo::model()->findAll('EndTime>:time ORDER BY Id DESC LIMIT 20',array(':time'=>date('Y-m-d H:i:s')));
			foreach($info as $item){
				$detail = WorkinfoDetail::model()->find('WorkinfoId=:Id',array(':Id'=>$item->Id));
				echo CHtml::openTag('div',array('class'=>'work-item2'));
				echo CHtml::link($detail->WorkName,array('workinfo/detail','id'=>$detail->Id),array('target'=>'_blank'));
				echo CHtml::openTag('span');
				$company = Company::model()->findByPk($item->CompanyId);
				echo CHtml::link($company->CompanyName,array('workinfo/index','id'=>$info->Id),array('target'=>'_blank'));
				echo CHtml::closeTag('span');
				echo CHtml::closeTag('div');
			}
		?>
		<div class='clear'></div>
	</div>
</div>
