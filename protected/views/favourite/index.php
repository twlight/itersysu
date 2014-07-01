<?php
/* @var $this FavouriteController */
/* @var $model Favourite */

$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'职位收藏夹',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>职位收藏夹</p>
		</div>
	</div>

<?php
	$this->widget('zii.widgets.CListView', array(
		'id'=>'fav-list',
		'dataProvider'=>$dataProvider,
		'itemView'=>'_items',
		'emptyText'=>'暂时没有数据',    
		'enableSorting'=>true,
		'enablePagination'=>true,
		'sortableAttributes'=>array(
		),
		'template'=>'{summary}{sorter}<div class="search-head"><div class="search-checkbox">全选</div><div class="search-batch">批量操作：<a class="delall" href="#">删除</a> 投递简历</div></div><div class="search-header"><div class="search-checkbox"><input type="checkbox" style="margin:0px;" id="chk-all"/></div><div class="search-workname">职位名称</div><div class="search-corpname">公司名称</div><div class="search-time">收藏时间</div><div class="search-operation">操作</div></div>{items}{pager}',
	));

	Yii::app()->clientScript->registerScript('js','
		$(document).on("click","a.delete",function() {
			if(!confirm("确定要删除这条数据吗?")) return false;
			$.fn.yiiListView.update("fav-list", {
				type:"POST",
				url:$(this).attr("href"),
				success:function(data) {
					$.fn.yiiListView.update("fav-list");
				},
				error:function(XHR) {
				}
			});
			return false;
		});

		$(document).on("click","#chk-all",function(){
			if($(this).is(":checked")){
				$(".items input[type=\'checkbox\']").attr("checked",true);
			}
			else{
				$(".items input[type=\'checkbox\']").attr("checked",false);
			}
		});

		$(document).on("click",".delall",function(){
			var str = "";
			$(".items input[type=\'checkbox\']").each(function(){
				if($(this).is(":checked"))
					str+=$(this).attr("id")+","
			});
			str = str.substr(0,str.length-1);
			var url = "'.Yii::app()->createUrl('favourite/delete').'";
			if(!confirm("确定要删除这些数据吗?")) return false;
			$.fn.yiiListView.update("fav-list", {
				type:"POST",
				url:url+"&str="+str+"&ajax=1",
				success:function(data) {
					$.fn.yiiListView.update("fav-list");
				},
				error:function(XHR) {
				}
			});
			return false;
		});
	',CClientScript::POS_READY);
?>
</div>
