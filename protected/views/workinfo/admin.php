<?php
$this->pageTitle=Yii::app()->name."- 招聘管理";
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'招聘管理',
);
?>

<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>警告: </strong>删除招聘会同时删除已投递的简历！</div>
<?php
	function getDetail($id){
		$workinfo = Workinfo::model()->findByPk($id);
		$detail = WorkinfoDetail::model()->findAll('WorkinfoId=:Id',array(':Id'=>$workinfo->Id));
		$str = '';
		foreach($detail as $item){
			$str .= $item->WorkName.',';
		}
		$str = substr($str,0,strlen($str)-1);
		return $str;
	}
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'workinfo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>true,
	'selectableRows'=>true,
	'columns'=>array(
		array(
			'name'=>'Hr',
			'header'=>'联系人',
		),
		array(
			'name'=>'Email',
			'header'=>'Email',
		),
		array(
			'name'=>'Tel',
			'header'=>'联系电话',
		),
		array(
			'name'=>'EndTime',
			'header'=>'截至时间',
		),
		array(
			'header'=>'招聘职位',
			'value'=>'getDetail($data->Id)',
		),
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl'=>'Yii::app()->createUrl("workinfo/index",array("id"=>$data->Id))',
			'updateButtonUrl'=>'Yii::app()->createUrl("workinfo/create",array("id"=>$data->Id))',
		),
	),
)); ?>
