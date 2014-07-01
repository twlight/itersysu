<div class='news-item'>
	<h2><?php echo CHtml::link($data['CompanyName'].' - '.$data['PostName'],array('share/detail','id'=>$data['Sid']),array('target'=>'_blank')); ?></h2>
	<div class='news-itemcontent'><span class='share-title'>面试过程：</span><?php echo mb_strlen($data['Process'],'utf8')>150 ? mb_substr($data['Process'],0,150,'utf8').'.....  ' : $data['Process']; ?></div>
	<div class='news-itemcontent'><span class='share-title'>面试官提到的问题：</span><?php echo mb_strlen($data['Question'],'utf8')>100 ? mb_substr($data['Question'],0,100,'utf8').'.....  ' : $data['Question']; echo CHtml::link('查看详细',array('share/detail','id'=>$data['Sid']),array('target'=>'_blank')); ?></div>
</div>
