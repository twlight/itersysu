<div class='announce-item'>
	<div class='announce-datetime'>
		<h4>
			<?php $arr = split('-',$data['Date']);?>
			<b><?php echo intval($arr[1]); ?></b>
				月
			<b><?php echo intval($arr[2]); ?></b>
				日
		</h4>
		<p><?php echo $data['StartTime'].'-'.$data['EndTime']; ?></p>
	</div>
	<div class='announce-main'>
		<h2><?php echo $data['CompanyName']; ?><p>(<?php echo $data['BusinessType'].'/'.$data['SubBusinessType']; ?>)</p></h2>
		<h3><?php echo $data['School']; ?><p>(<?php echo $data['City']; ?>)</p></h3>
		<h4><?php echo $data['Address']; ?></h4>
	</div>
	<div class='announce-fav'>
		<?php if(Yii::app()->user->isGuest || Yii::app()->user->UserType == 0 || Yii::app()->user->UserType == 2): ?>
		<?php echo CHtml::link('收藏',array('announce/addfav','id'=>$data['fid']),array('class'=>'btn btn-success')); ?>
		<?php endif ?>
	</div>
	<div class='clear'></div>
</div>
