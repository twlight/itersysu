<?php echo CHtml::beginForm(); ?>
<div class="form">
	<?php foreach($model->RExp as $item): ?>
	<fieldset class='part'>
		<legend>工作信息</legend>
		<div class="remove">删除工作信息×</div>
		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('StartDate').'<span class="required">*</span>','StartDate_1'); ?>
			<?php echo CHtml::textField('RExpForm[StartDate][]',$item->StartDate,array('id'=>'StartDate_1','class'=>'startdate')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('EndDate').'<span class="required">*</span>','EndDate_1'); ?>
			<?php echo CHtml::textField('RExpForm[EndDate][]',$item->EndDate,array('id'=>'EndDate_1','class'=>'enddate')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('CompanyName').'<span class="required">*</span>','CompanyName_1'); ?>
			<?php echo CHtml::textField('RExpForm[CompanyName][]',$item->CompanyName,array('id'=>'CompanyName_1','class'=>'companyname')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('Type').'<span class="required">*</span>','Type_1'); ?>
			<?php echo CHtml::dropDownList('RExpForm[Type][]',$item->Type,Info::getWorkTypeByArray(),array('id'=>'Type_1','class'=>'type')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('CompanyType').'<span class="required">*</span>','CompanyType_1'); ?>
			<?php echo CHtml::dropDownList('RExpForm[CompanyType][]',$item->CompanyType,Info::getCompanyTypeByArray(),array('id'=>'CompanyType_1','class'=>'companytype')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('CompanyScope').'<span class="required">*</span>','CompanyScope_1'); ?>
			<?php echo CHtml::dropDownList('RExpForm[CompanyScope][]',$item->CompanyScope,Info::getScopeByArray(),array('id'=>'CompanyScope_1','class'=>'companyscope')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('PostName').'<span class="required">*</span>','PostName_1'); ?>
			<?php echo CHtml::textField('RExpForm[PostName][]',$item->PostName,array('id'=>'PostName_1','class'=>'postname')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('WorkContent').'<span class="required">*</span>','WorkContent_1'); ?>
			<?php echo CHtml::textArea('RExpForm[WorkContent][]',$item->WorkContent,array('id'=>'WorkContent_1','class'=>'workcontent')); ?>
		</div>
	</fieldset>
	<?php endforeach ?>
	<a href='#' id='addexp' class='btn'>添加工作信息</a>

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
			var part = '<fieldset class=\"part\"><legend>工作信息<span class=\"required\">*</span></legend><div class=\"remove\">删除工作信息×</div><div class=\"row\">';
			part += '<label for=\"StartDate_'+i+'\">开始日期<span class=\"required\">*</span></label>';
			part += '<input id=\"StartDate_'+i+'\" class=\"startdate\" type=\"text\" value=\"\" name=\"RExpForm[StartDate][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"EndDate_'+i+'\">结束日期<span class=\"required\">*</span></label>';
			part += '<input id=\"EndDate_'+i+'\" class=\"enddate\" type=\"text\" value=\"\" name=\"RExpForm[EndDate][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"CompanyName_'+i+'\">公司名称<span class=\"required\">*</span></label>';
			part += '<input id=\"CompanyName_'+i+'\" class=\"companyname\" type=\"text\" value=\"\" name=\"RExpForm[CompanyName][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"Type_'+i+'\">工作类型<span class=\"required\">*</span></label>';
			part += '<select id=\"Type_'+i+'\" class=\"type\" name=\"RExpForm[Type][]\"><option value=\"0\">全职</option><option value=\"1\">兼职</option><option value=\"2\">实习</option></select>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"CompanyType_'+i+'\">公司类型<span class=\"required\">*</span></label>';
			part += '<select id=\"CompanyType_'+i+'\" class=\"companytype\" name=\"RExpForm[CompanyType][]\"><option value=\"0\">民营企业</option><option value=\"1\">国有企业</option><option value=\"2\">中外合资企业</option><option value=\"3\">外商独资企</option><option value=\"4\">股份制企业</option><option value=\"5\">上市公司</option><option value=\"6\">国家机关</option><option value=\"7\">事业单位</option><option value=\"8\">其它</option></select>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"CompanyScope_'+i+'\">公司规模<span class=\"required\">*</span></label>';
			part += '<select id=\"CompanyScope_'+i+'\" class=\"companyscope\" name=\"RExpForm[CompanyScope][]\"><option value=\"0\">10人以下</option><option value=\"1\">10-49人</option><option value=\"2\">50-99人</option><option value=\"3\">100-499人</option><option value=\"4\">500-999人</option><option value=\"5\">1000-4999人</option><option value=\"6\">5000-1万人</option><option value=\"7\">1万人以上</option></select>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"PostName_'+i+'\">职位名称<span class=\"required\">*</span></label>';
			part += '<input id=\"PostName_1\" class=\"postname\" type=\"text\" value=\"\" name=\"RExpForm[PostName][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"WorkContent_'+i+'\">工作内容<span class=\"required\">*</span></label>';
			part += '<textarea id=\"WorkContent_'+i+'\" class=\"workcontent\" name=\"RExpForm[WorkContent][]\"></textarea>';
			part += '</div></fieldset>';
			return part;
		}

		var i = 2;
		$('#addexp').click(function(){
			$('.part:last').after(getPart(i++));
			$('.startdate').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,minView:'2'});
			$('.enddate').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,minView:'2'});
			return false;
		});

		$(document).on('click','.remove',function(){
			if($('.part').length <= 1){
				alert('工作信息不能为空.');
			}
			else{
				$(this).parent().remove();
			}
		});
	",CClientScript::POS_READY);
?>
