<div class='search-item'>
	<div class='search-checkbox2'>
		<input type='checkbox' id='<?php echo $data['fid']; ?>'/>
	</div>
	<div class='search-workname2'>
		<?php echo CHtml::link($data['WorkName'],array('workinfo/detail','id'=>$data['WorkinfoDetailId']),array('target'=>'_blank')); ?>
	</div>
	<div class='search-corpname2'>
		<?php echo CHtml::link($data['CompanyName'],array('workinfo/index','id'=>$data['WorkinfoId']),array('target'=>'_blank')); ?>
	</div>
	<div class='search-time2'>
		<?php echo $data['Time']; ?>
	</div>
	<div class='search-operation2'>
		<?php echo CHtml::link('删除',array('favourite/delete','str'=>$data['fid'],'ajax'=>'1'),array('class'=>'btn btn-danger btn-mini delete')); ?>
	</div>
	<div class='search-info'>
		月薪：<?php echo $data['Pay'] == 0 ? '面议' : $data['Pay']; ?> &nbsp;|&nbsp; 公司性质：<?php echo Info::getCompanyType($data['Type']); ?> &nbsp;|&nbsp; 工作经验：<?php echo $data['Experience'] == 0 ? '不限' : $data['Experience']; ?> &nbsp;|&nbsp; 学历要求：<?php echo Info::getEdu_Corp($data['Edu']); ?>
	</div>
</div>
