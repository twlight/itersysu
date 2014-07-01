<?php
	$this->pageTitle=Yii::app()->name . ' - 宣讲会';

	$this->widget('zii.widgets.CListView', array(
		'id'=>'announce-list',
		'dataProvider'=>$dataProvider,
		'itemView'=>'_items',   // refers to the partial view named '_post'
		'emptyText'=>'暂时没有数据',    
		'enableSorting'=>true,
		'enablePagination'=>true,
		'sortableAttributes'=>array(
		),
		'template'=>'{summary}{sorter}{items}{pager}',
	));

	if(Yii::app()->user->isGuest){
		Yii::app()->clientScript->registerScript('js','
			$(document).on("click",".announce-fav a",function() {
				$("#login").modal({
					backdrop:true,
					keyboard:true,
					show:true
				});
				return false;
			});
		',CClientScript::POS_LOAD);
	}
	else{
		Yii::app()->clientScript->registerScript('js','
			$(document).on("click",".announce-fav a",function() {
				$.ajax({
					url:$(this).attr("href"),
					type:"POST",
					success:function(){
						$("#favsuccess").modal({
							backdrop:true,
							keyboard:true,
							show:true
						});
					},
				});
				return false;
			});
		',CClientScript::POS_LOAD);
	}
?>

<div class="modal hide fade" id='favsuccess'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>收藏成功</h3>
	</div>
	<div class="modal-body">
		<p>收藏成功！</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo Yii::app()->createUrl('announce/fav'); ?>" class="btn">转到“宣讲会收藏”</a>
		<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
	</div>
</div>

<div class="modal hide fade" id='login'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>登陆</h3>
	</div>
	<div class="modal-body">
		<p>你尚未登陆！</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo Yii::app()->createUrl('site/userReg'); ?>" class="btn">注册</a>
		<a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="btn btn-primary">登陆</a>
	</div>
</div>
