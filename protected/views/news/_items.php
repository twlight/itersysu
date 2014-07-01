<div class='news-item'>
	<h2><?php echo CHtml::link($data['Title'],array('news/detail','id'=>$data['Nid']),array('target'=>'_blank')); ?></h2>
	<div class='news-iteminfo'>发布时间：<em><?php echo $data['PostTime']; ?></em></div>
	<div class='news-iteminfo'>点击次数：<em><?php echo $data['Clicked']; ?></em></div>
	<div class='news-itemcontent'><?php echo mb_strlen($data['Content'],'utf8')>100 ? mb_substr($data['Content'],0,100,'utf8').'.....  ' : $data['Content']; echo CHtml::link('查看全文',array('news/detail','id'=>$data['Nid']),array('target'=>'_blank')); ?></div>
</div>
