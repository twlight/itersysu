<?php
$this->pageTitle=Yii::app()->name . ' - 我的分享';
$this->breadcrumbs=array(
	'面试经历'=>array('share/index'),
	'我的分享',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>我的分享</p>
		</div>
	</div>

<div class='news-body'>
	<div class="news-head">
		<h1>搜索</h1>
	</div>
	<div class='news-list'>
		<div class="search-main">
			<div class="search-form">
				<form action='<?php echo Yii::app()->createUrl('share/search'); ?>' method='get'>
					<input type='hidden' name='r' value='share/search'/>
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
		'itemView'=>'_items',
		'emptyText'=>'你没有分享面试经历 - '.CHtml::link('立即分享',array('share/create')),
		'enableSorting'=>true,
		'enablePagination'=>true,
		'sortableAttributes'=>array(
		),
		'template'=>'{summary}{sorter}<div class="news-body"><div class="news-head"><h1>我的分享</h1></div>{items}</div>{pager}',
	));
?>
</div>
