<?php
$this->pageTitle=Yii::app()->name . ' - 职场资讯';
?>


<div class="info body">
	<div class="com-user-box">
		<div class="titbox">
			<p>职场资讯</p>
		</div>
	</div>

<div class='span11 news-search news-box'>
	<div class='title'>
		<strong>搜索</strong>
	</div>
	<div class='clear'></div>
	<div class='news-list'>
		<div class="search-main">
			<div class="search-form">
				<form action='<?php echo Yii::app()->createUrl('news/search'); ?>' method='get'>
					<input type='hidden' name='r' value='news/search'/>
					<input type="text" id="search-text" autocomplete="off" name='key' placeholder='请输入关键字' style='width: 750px;'/>
					<input type="submit" value="搜索" class="search-button"  style='width:78px;'/>
				</form>
			</div>
		</div>
	</div>
</div>
	
<div class='span8 news-box'>
	<div class='title'>
		<strong>最新文章</strong>
	</div>
	<div class='clear'></div>
	<div class='news-title'><?php echo CHtml::link($latest->Title,array('news/detail','id'=>$latest->Id),array('target'=>'_blank')); ?></div>
	<div class='news-info'><?php echo mb_substr($latest->Content,0,200,'utf8').'.....'.CHtml::link('查看详细',array('news/detail','id'=>$latest->Id),array('target'=>'_blank')); ?></div>
</div>
<div class='span3 news-box'>
	<div class='title'>
		<strong>推荐资讯</strong>
	</div>
	<div class='clear'></div>
	<div class='news-list'>
		<ul>
			<?php foreach($recommend as $item): ?>
			<li><?php echo CHtml::link($item->Title,array('news/detail','id'=>$item->Id),array('target'=>'_blank')); ?></li>
			<?php endforeach ?>
		</ul>
	</div>
</div>

<?php
	$sort = NSort::model()->findAll();
	$i = 0;
	foreach($sort as $item){
		if($i == 0){
			echo CHtml::openTag('div',array('class'=>'span6 news-box'));
			$i++;
		}
		else{
			echo CHtml::openTag('div',array('class'=>'span5 news-box'));
			$i--;
		}
		echo CHtml::openTag('div',array('class'=>'title'));
		echo CHtml::tag('strong',array(),$item->Name);
		echo CHtml::openTag('div',array('class'=>'more'));
		echo CHtml::link('更多...',array('news/more','id'=>$item->Id),array('target'=>'_blank'));
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
		echo CHtml::tag('div',array('class'=>'clear'),'');
		echo CHtml::openTag('div',array('class'=>'news-list'));
		echo CHtml::openTag('ul');
		$news = News::model()->findAll('SortId=:Id ORDER BY PostTime DESC LIMIT 10',array(':Id'=>$item->Id));
		foreach($news as $it){
			echo CHtml::openTag('li');
			echo CHtml::link($it->Title,array('news/detail','id'=>$it->Id),array('target'=>'_blank'));
			echo CHtml::closeTag('li');
		}
		echo CHtml::closeTag('ul');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}
?>
</div>
