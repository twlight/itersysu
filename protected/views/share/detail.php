<?php
$this->pageTitle=Yii::app()->name . ' - 面试经历';
$sort = NSort::model()->findByPk($news->SortId);
$this->breadcrumbs=array(
	'面试经历'=>array('share/index'),
	$model->CompanyName.'的面试经历',
);
?>

<?php
	function getWay($id){
		if($id == 0){
			return '社会招聘';
		}
		else if($id == 1){
			return '校园招聘';
		}
		else{
			return '其他';
		}
	}

	function getMethod($id){
		if($id == 0){
			return '1对1面试';
		}
		else if($id == 1){
			return '1对多面试';
		}
		else if($id == 2){
			return '群面';
		}
		else{
			return '其他';
		}
	}

	function getDifficulty($id){
		if($id == 0){
			return '简单';
		}
		else if($id == 1){
			return '一般';
		}
		else if($id == 2){
			return '稍难';
		}
		else if($id == 3){
			return '难';
		}
		else if($id == 4){
			return '很难';
		}
		else{
			return '未知';
		}
	}

	function getFeel($id){
		if($id == 0){
			return '简单';
		}
		else if($id == 1){
			return '一般';
		}
		else if($id == 2){
			return '好';
		}
		else if($id == 3){
			return '很好';
		}
		else{
			return '未知';
		}
	}
?>

<div class='news-main span8'>
	<h1><?php echo $model->CompanyName.' - '.$model->PostName; ?></h1>
	<p><span class='share-strong'>面试时间：</span><?php echo $model->AuditionTime; ?></p>
	<p><span class='share-strong'>面试城市：</span><?php echo $model->Place; ?></p>
	<p><span class='share-strong'>花费时间：</span><?php echo $model->CostTime; ?>小时</p>
	<p><span class='share-strong'>面试过程：</span></p>
	<?php
		$arr = explode("\n",$model->Process);
		foreach($arr as $item){
			$t = trim($item);
			$t = str_replace('　　','',$t);
			echo CHtml::tag('p',array(),$t);
		}
	?>
	<p><span class='share-strong'>面试官提到的问题：</span></p>
	<?php
		$arr = explode("\n",$model->Question);
		foreach($arr as $item){
			$t = trim($item);
			$t = str_replace('　　','',$t);
			echo CHtml::tag('p',array(),$t);
		}
	?>
	<p><span class='share-strong'>应聘途径：</span><?php echo getWay($model->Way); ?></p>
	<p><span class='share-strong'>面试形式：</span><?php echo getMethod($model->Method); ?></p>
	<p><span class='share-strong'>面试难度：</span><?php echo getDifficulty($model->Difficulty); ?></p>
	<p><span class='share-strong'>面试感觉：</span><?php echo getFeel($model->Feel); ?></p>
</div>
<div class='span3'>
	<div class='news-box news-search' style='margin-top:0px;'>
		<div class='title'>
			<strong>搜索</strong>
		</div>
		<div class='news-list'>
			<div class="search-main" style='margin:2px 0px;'>
				<div class="search-form">
					<form action='<?php echo Yii::app()->createUrl('share/search'); ?>' method='get' style=''>
						<input type='hidden' name='r' value='share/search'/>
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
			<strong>类似职位其他公司面试</strong>
		</div>
		<div class='clear'></div>
		<div class='news-list'>
			<ul>
				<?php
					$share = ShareAudition::model()->findAll('PostName LIKE :name AND Id!=:Id',array(':name'=>'%'.$model->PostName.'%',':Id'=>$model->Id)); 
					if(count($share)==0){
						echo CHtml::tag('li',array(),'暂无推荐');
					}
					else{
						foreach($share as $item){
							echo CHtml::openTag('li');
							echo CHtml::link($item->CompanyName.' - '.$item->PostName,array('share/detail','id'=>$item->Id));
							echo CHtml::closeTag('li');
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>
