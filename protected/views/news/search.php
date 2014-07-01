<?php
$this->pageTitle=Yii::app()->name . ' - 职场资讯搜索结果';
$this->breadcrumbs=array(
	'职场资讯'=>array('news/index'),
	'搜索结果',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>搜索结果</p>
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
					<input type="text" id="search-text" autocomplete="off" name='key' value=<?php echo $key; ?> placeholder='请输入关键字' style='width:810px;'/>
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
		'itemView'=>'_items',
		'emptyText'=>'没有找到"'.$key.'"的搜索结果', 
		'enableSorting'=>true,
		'enablePagination'=>true,
		'sortableAttributes'=>array(
		),
		'template'=>'{summary}{sorter}<div class="news-body"><div class="news-head"><h1>"'.$key.'"的搜索结果</h1></div>{items}</div>{pager}',
	));
?>
</div>
