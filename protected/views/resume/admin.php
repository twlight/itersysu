<?php
$this->pageTitle=Yii::app()->name . ' - 简历管理';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'简历管理',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>简历管理</p>
		</div>
	</div>

<div class='btn-group'>
	<button class='btn btn-mini btn-success' id='process1'>标记为“已处理”</button>
	<button class='btn btn-mini btn-danger' id='process2'>标记为“未处理”</button>
</div>
<p style='float:right;'>筛选：<a href='<?php echo Yii::app()->createUrl('resume/admin',array('p'=>1)); ?>' id="processed">已处理</a>   <a href='<?php echo Yii::app()->createUrl('resume/admin',array('p'=>0)); ?>' id='unprocessed'>未处理</a></p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resume-admin-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'selectableRows'=>2,
			'value'=>'$data["sid"]',
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'职位名称',
			'labelExpression'=>'$data["WorkName"]',
			'urlExpression'=>'Yii::app()->createUrl("workinfo/detail",array("id"=>$data["wid"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'简历名称',
			'labelExpression'=>'$data["ResumeName"]',
			'urlExpression'=>'Yii::app()->createUrl("resume/adminview",array("sid"=>$data["sid"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
		),
		array(
			'name'=>'Username',
			'header'=>'姓名',
		),
		array(
			'name'=>'Sex',
			'header'=>'性别',
			'value'=>'Info::getSex($data["Sex"])',
		),
		array(
			'name'=>'Edu',
			'header'=>'学历',
			'value'=>'Info::getEdu_User($data["Edu"])',
		),
		array(
			'name'=>'Experience',
			'header'=>'经验',
			'value'=>'Info::getExperience_User($data["Experience"])',
		),
		array(
			'name'=>'Time',
			'header'=>'投递时间',
		),
		array(
			'name'=>'Processed',
			'header'=>'状态',
			'value'=>'$data["Processed"] == 1 ? "已处理" : "未处理"',
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'下载简历',
			'label'=>'点此下载',
			'urlExpression'=>'Yii::app()->createUrl("resume/download",array("id"=>$data["rid"]))',
			'linkHtmlOptions'=>array(
				'target'=>'_blank',
			),
		),
	),
)); 

	Yii::app()->clientScript->registerScript('js','
		$(document).on("click","#process1",function(){
			var str = "";
			$("tbody tr td.checkbox-column input[type=\'checkbox\']").each(function(){
				if($(this).is(":checked"))
					str+=$(this).val()+","
			});
			str = str.substr(0,str.length-1);
			var url = "'.Yii::app()->createUrl('resume/process').'";
			$.ajax({
				url:url+"&str="+str,
				type:"POST",
				success:function(){
					$("#tips").modal({
						backdrop:true,
						keyboard:true,
						show:true
					});
					$.fn.yiiGridView.update("resume-admin-grid");
				}
			});
			return false;
		});

		$(document).on("click","#process2",function(){
			var str = "";
			$("tbody tr td.checkbox-column input[type=\'checkbox\']").each(function(){
				if($(this).is(":checked"))
					str+=$(this).val()+","
			});
			str = str.substr(0,str.length-1);
			var url = "'.Yii::app()->createUrl('resume/process').'";
			$.ajax({
				url:url+"&str="+str+"&t=0",
				type:"POST",
				success:function(){
					$("#tips").modal({
						backdrop:true,
						keyboard:true,
						show:true
					});
					$.fn.yiiGridView.update("resume-admin-grid");
				}
			});
			return false;
		});

		$(document).on("click","#processed",function(){
			var u = $(this).attr("href");
			$.fn.yiiGridView.update("resume-admin-grid",{url:u});
			return false;
		});

		$(document).on("click","#unprocessed",function(){
			var u = $(this).attr("href");
			$.fn.yiiGridView.update("resume-admin-grid",{url:u});
			return false;
		});
	',CClientScript::POS_LOAD);

?>

<div class="modal hide fade" id='tips'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>提示</h3>
	</div>
	<div class="modal-body">
		<p>操作成功！</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">关闭</a>
	</div>
</div>
</div>
