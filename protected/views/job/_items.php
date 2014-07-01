<div class='search-item'>
	<div class='search-checkbox2'>
		<input type='checkbox' id='<?php echo $data['did']; ?>'/>
	</div>
	<div class='search-workname2'>
		<?php echo CHtml::link($data['WorkName'],array('workinfo/detail','id'=>$data['WorkinfoDetailId']),array('target'=>'_blank')); ?>
	</div>
	<div class='search-corpname2'>
		<?php echo CHtml::link($data['CompanyName'],array('workinfo/index','id'=>$data['WorkinfoId']),array('target'=>'_blank')); ?>
	</div>
	<div class='search-place2'>
		<?php echo $data['ZhaoPin_Place']; ?>
	</div>
	<div class='search-posttime2'>
		<?php echo $data['PostTime']; ?>
	</div>
	<div class='search-info'>
		招聘人数：<?php echo $data['OfferNum'] == 0 ? '若干' : $data['OfferNum']; ?> &nbsp;|&nbsp; 月薪：<?php echo $data['Pay'] == 0 ? '面议' : $data['Pay']; ?> &nbsp;|&nbsp; 公司性质：<?php echo Info::getCompanyType($data['Type']); ?>
	</div>
	<?php if(Yii::app()->user->isGuest || Yii::app()->user->UserType == 0 || Yii::app()->user->UserType == 2): ?>
	<div class='search-posttime2'>
		<?php echo CHtml::link('收藏职位',array('favourite/add','str'=>$data['did']),array('class'=>'btn btn-mini fav')); ?>
	</div>
	<?php endif ?>
	<div class='search-info'>
		工作经验：<?php echo Info::getExperience_Corp($data['Experience']); ?> &nbsp;|&nbsp; 学历要求：<?php echo Info::getEdu_Corp($data['Edu']); ?>
	</div>
	<?php if(Yii::app()->user->isGuest || Yii::app()->user->UserType == 0 || Yii::app()->user->UserType == 2): ?>
	<div class='search-posttime2'>
		<?php echo CHtml::link('投递简历','#',array('class'=>'btn btn-mini btn-primary post','id'=>'resume'.$data['did'])); ?>
	</div>
	<?php endif ?>
	<!--<div class='search-info search-intro'>
		<?php
			/*$intro = $data['Introduction'];
			if(mb_strlen($intro,'utf-8') > 100){
				$intro = mb_substr($intro,0,100,'utf-8');
			}
			echo $intro;*/
		?>
	</div>-->
</div>
