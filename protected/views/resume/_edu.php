<?php echo CHtml::beginForm(); ?>
<div class="form">
	<?php foreach($model->REdu as $item): ?>
	<fieldset class='part'>
		<legend>教育信息</legend>
		<div class='remove'>删除教育信息×</div>
		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('StartDate').'<span class="required">*</span>','StartDate_1'); ?>
			<?php echo CHtml::textField('REduForm[StartDate][]',$item->StartDate,array('id'=>'StartDate_1','class'=>'startdate')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('EndDate').'<span class="required">*</span>','EndDate_1'); ?>
			<?php echo CHtml::textField('REduForm[EndDate][]',$item->EndDate,array('id'=>'EndDate_1','class'=>'enddate')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('SchoolName').'<span class="required">*</span>','SchoolName_1'); ?>
			<?php echo CHtml::textField('REduForm[SchoolName][]',$item->SchoolName,array('id'=>'SchoolName_1','class'=>'schoolname')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('SpecialtyName'),'SpecialtyName_1'); ?>
			<?php echo CHtml::textField('REduForm[SpecialtyName][]',$item->SpecialtyName,array('id'=>'SpecialtyName_1','class'=>'specialtyname')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('EduBak').'<span class="required">*</span>','EduBak_1'); ?>
			<?php echo CHtml::dropDownList('REduForm[EduBak][]',$item->Edu,Info::getEdu_UserByArray(),array('id'=>'EduBak_1','class'=>'edubak')); ?>
		</div>
	</fieldset>
	<?php endforeach ?>
	<a href='#' id='addedu' class='btn'>添加教育信息</a>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存并跳转下一步'); ?>
	</div>
</div><!-- form -->
<?php echo CHtml::endForm();?>
<?php
	Yii::app()->clientScript->registerScript('js', "
		$('.startdate').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,minView:'2'});
		$('.enddate').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,minView:'2'});

		var getPart = function(i){
			var part = '<fieldset class=\"part\"><legend>教育信息</legend><div class=\'remove\'>删除教育信息×</div><div class=\"row\">';
			part += '<label for=\"StartDate_'+i+'\">开始日期<span class=\"required\">*</span></label>';
			part += '<input id=\"StartDate_'+i+'\" class=\"startdate\" type=\"text\" value=\"\" name=\"REduForm[StartDate][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"EndDate_'+i+'\">结束日期<span class=\"required\">*</span></label>';
			part += '<input id=\"EndDate_'+i+'\" class=\"enddate\" type=\"text\" value=\"\" name=\"REduForm[EndDate][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"SchoolName_'+i+'\">学校名称<span class=\"required\">*</span></label>';
			part += '<input id=\"SchoolName_'+i+'\" class=\"schoolname\" type=\"text\" value=\"\" name=\"REduForm[SchoolName][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"SpecialtyName_'+i+'\">专业名称</label>';
			part += '<input id=\"SpecialtyName_'+i+'\" class=\"specialtyname\" type=\"text\" value=\"\" name=\"REduForm[SpecialtyName][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"EduBak_'+i+'\">学历<span class=\"required\">*</span></label>';
			part += '<select id=\"EduBak_'+i+'\" class=\"edubak\" name=\"REduForm[EduBak][]\"><option value=\"0\">初中</option><option value=\"1\">中专</option><option value=\"2\">高中</option><option value=\"3\">大专</option><option value=\"4\">本科</option><option value=\"5\">硕士研究生</option><option value=\"6\">博士及以上</option></select>';
			part += '</div></fieldset>';
			return part;
		}

		var i = 2;
		$('#addedu').click(function(){
			$('.part:last').after(getPart(i++));
			$('.startdate').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,minView:'2'});
			$('.enddate').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,minView:'2'});
			return false;
		});

		$(document).on('click','.remove',function(){
			if($('.part').length <= 1){
				alert('教育信息不能为空.');
			}
			else{
				$(this).parent().remove();
			}
		});
	",CClientScript::POS_READY);
?>
