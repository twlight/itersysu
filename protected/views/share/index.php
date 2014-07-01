<?php
	$this->pageTitle=Yii::app()->name . ' - 面试经历';
?>

<div class='span8'>
	<div class='news-list'>
		<div class="search-main">
			<div class="search-form">
				<form action='<?php echo Yii::app()->createUrl('share/search'); ?>' method='get'>
					<input type='hidden' name='r' value='share/search'/>
					<input type="text" id="search-text" autocomplete="off" name='key' placeholder='请输入关键字' style='width: 510px;'/>
					<input type="submit" value="搜索" class="search-button"  style='width:78px;'/>
				</form>
			</div>
		</div>
	</div>
</div>

<div class='span3'>
	<a href='<?php echo Yii::app()->createUrl('share/create'); ?>' title='分享我的面试经历' target='_blank'>
		<img src='<?php echo Yii::app()->request->baseUrl; ?>./images/fb.gif' alt='分享我的面试经历' style='margin-top:7px;'/>
	</a>
</div>
	

<div class="span8 news-box">
	<div class="title">
		<strong>热门企业面试经历</strong>
	</div>
	<div class="clear"></div>
	<div class='share-table'>
		<table>
			<tbody>
			<?php 
				if(count($data)%2 != 0){
					array_pop($data);
				}
				$i = 0;
				foreach($data as $item){
					if($i == 0){
						echo CHtml::openTag('tr');
					}
					echo CHtml::openTag('td');
					$share = ShareAudition::model()->find('CompanyName=:name',array(':name'=>$item['CompanyName']));
					echo CHtml::link($item['CompanyName'],array('share/detail','id'=>$share->Id),array('target'=>'_blank'));
					echo CHtml::openTag('span');
					echo CHtml::encode('共有');
					echo CHtml::tag('strong',array(),$item['c']);
					echo CHtml::encode('条面试经验');
					echo CHtml::closeTag('span');
					echo CHtml::closeTag('td');
					if($i == 1){
						echo CHtml::closeTag('tr');
					}
					$i++;
					if($i == 2){
						$i = 0;
					}
				}
			?>
			</tbody>
		</table>
	</div>
</div>

<div class="span3 news-box">
	<div class="title">
		<strong>热门职位面试经历</strong>
	</div>
	<div class="clear"></div>
	<div class="news-list">
		<ul>
			<?php foreach($data2 as $item): ?>
			<?php $share = ShareAudition::model()->find('PostName=:name ORDER BY Id DESC',array(':name'=>$item['PostName'])); ?>
			<li><a target="_blank" href="<?php echo Yii::app()->createUrl('share/detail',array('id'=>$share->Id)); ?>"><?php echo $item['PostName']; ?></a></li>
			<?php endforeach ?>
		</ul>
	</div>

	<?php if(!Yii::app()->user->isGuest): ?>
	<div class="title">
		<strong>热门职位面试经历</strong>
	</div>
	<div class="clear"></div>
	<div class="news-list">
		<a href='<?php echo Yii::app()->createUrl('share/my'); ?>'><div class='resume-button' style='margin-top:3px;'>查看我的分享</div></a>
	</div>
	<?php endif ?>
</div>
