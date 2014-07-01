<?php
$this->pageTitle=Yii::app()->name . ' - 职场资讯.'.$news->Title;
$sort = NSort::model()->findByPk($news->SortId);
$this->breadcrumbs=array(
	'职场资讯'=>array('news/index'),
	$sort->Name=>array('news/more','id'=>$sort->Id),
	$news->Title,
);
?>

<div class='news-main span8'>
	<h1><?php echo $news->Title; ?></h1>
	<div class='info'><span>点击次数：<?php echo $news->Clicked; ?></span><span>发布时间：<?php echo $news->PostTime; ?></span><span><a href='#' id='like' style='font-weight:bold;font-size:14px;'><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/finger.jpg' alt='Like' style='width:10px;margin-right:2px;'/>Like(<?php echo $news->Like; ?>)</a></span></div>
	<?php
		$arr = explode("\n",$news->Content);
		foreach($arr as $item){
			$t = trim($item);
			$t = str_replace('　　','',$t);
			echo CHtml::tag('p',array(),$t);
		}
	?>
</div>
<div class='span3'>
	<div class='news-box news-search' style='margin-top:0px;'>
		<div class='title'>
			<strong>搜索</strong>
		</div>
		<div class='news-list'>
			<div class="search-main" style='margin:2px 0px;'>
				<div class="search-form">
					<form action='<?php echo Yii::app()->createUrl('news/search'); ?>' method='get' style=''>
						<input type='hidden' name='r' value='news/search'/>
						<input type="text" id="search-text" autocomplete="off" name='key' placeholder='请输入关键字' style='width:111px;'/>
						<input type="submit" value="搜索" class="search-button"  style='width:78px;'/>
					</form>
				</div>
			</div>
		</div>
		<div class='clear'></div>
	</div>

	<div class='news-box'>
		<div class='title'>
			<strong>推荐资讯</strong>
		</div>
		<div class='clear'></div>
		<div class='news-list'>
			<ul>
				<?php $recommend = News::model()->findAll('1 ORDER BY Clicked DESC LIMIT 10'); ?>
				<?php foreach($recommend as $item): ?>
				<li><?php echo CHtml::link($item->Title,array('news/detail','id'=>$item->Id),array('target'=>'_blank','title'=>$item->Title)); ?></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>

	<div class='news-box'>
		<div class='title'>
			<strong>最新资讯</strong>
		</div>
		<div class='clear'></div>
		<div class='news-list'>
			<ul>
				<?php $recommend = News::model()->findAll('1 ORDER BY PostTime DESC LIMIT 10'); ?>
				<?php foreach($recommend as $item): ?>
				<li><?php echo CHtml::link($item->Title,array('news/detail','id'=>$item->Id),array('target'=>'_blank','title'=>$item->Title)); ?></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>

	<div class='news-box'>
		<div class='title'>
			<strong>资讯分类</strong>
		</div>
		<div class='clear'></div>
		<div class='news-list'>
			<ul>
				<?php $sort = NSort::model()->findAll(); ?>
				<?php foreach($sort as $item): ?>
				<li><?php echo CHtml::link($item->Name,array('news/more','id'=>$item->Id),array('target'=>'_blank','title'=>$item->Name)); ?></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>

<?php
	Yii::app()->clientScript->registerScript('js','
		$(document).on("click","#like",function() {
			var id = '.$news->Id.';
			if($.cookie("newsdetail"+id)){
			}
			else{
				$.ajax({
					url:"'.Yii::app()->createUrl('news/like',array('id'=>$news->Id)).'",
					type:"POST",
					dataType : "html",
					success:function(data){
						$.cookie("newsdetail"+id,"1");
						$("#like").html($(data).find("#like").html());
					},
				});
			}
			return false;
		});
	',CClientScript::POS_END);
?>
