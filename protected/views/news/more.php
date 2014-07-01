<?php
$this->pageTitle=Yii::app()->name . ' - 职场资讯.'.$sort->Name;
$this->breadcrumbs=array(
	'职场资讯'=>array('news/index'),
	$sort->Name,
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p><?php echo $sort->Name; ?></p>
		</div>
	</div>

<div class='news-body'>
	<div class="news-head">
		<h1>搜索</h1>
	</div>
	<div class='news-list'>
		<div class="search-main">
			<div class="search-form">
				<form action='<?php echo Yii::app()->createUrl('news/search'); ?>' method='get'>
					<input type='hidden' name='r' value='news/search'/>
					<input type="text" id="search-text" autocomplete="off" name='key' placeholder='请输入关键字' style='width:810px;'/>
					<input type="submit" value="搜索" class="search-button"  style='width:78px;'/>
				</form>
			</div>
		</div>
	</div>
	<div class='clear'></div>
</div>

<?php
	$this->widget('zii.widgets.CListView', array(
		'id'=>'news-list',
		'dataProvider'=>$dataProvider,
		'itemView'=>'_items',   // refers to the partial view named '_post'
		'emptyText'=>'暂时没有数据',    
		'enableSorting'=>true,
		'enablePagination'=>true,
		'sortableAttributes'=>array(
		),
		'template'=>'{summary}{sorter}<div class="news-body"><div class="news-head"><h1>'.$sort->Name.'</h1></div>{items}</div>{pager}',
	));
?>
</div>
