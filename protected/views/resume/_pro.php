<?php echo CHtml::beginForm(); ?>
<div class="form">
	<?php foreach($model->RPro as $item): ?>
	<fieldset class='part'>
		<legend>项目信息</legend>
		<div class='remove'>删除项目信息×</div>
		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('Name').'<span class="required">*</span>','Name_1'); ?>
			<?php echo CHtml::textField('RProForm[Name][]',$item->Name,array('id'=>'Name_1','class'=>'name')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('Role').'<span class="required">*</span>','Role_1'); ?>
			<?php echo CHtml::textField('RProForm[Role][]',$item->Role,array('id'=>'Role_1','class'=>'role')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('Introduction').'<span class="required">*</span>','Introduction_1'); ?>
			<?php echo CHtml::textArea('RProForm[Introduction][]',$item->Introduction,array('id'=>'Introduction_1','class'=>'introduction')); ?>
		</div>

		<div class="row">
			<?php echo CHtml::label($model->getAttributeLabel('Content').'<span class="required">*</span>','Content_1'); ?>
			<?php echo CHtml::textArea('RProForm[Content][]',$item->Content,array('id'=>'Content_1','class'=>'content')); ?>
		</div>
	</fieldset>
	<?php endforeach ?>
	<a href='#' id='addpro' class='btn'>添加项目信息</a>

	<div class="row submit">
		<?php echo CHtml::submitButton('保存并跳转下一步'); ?>
	</div>
</div><!-- form -->
<?php echo CHtml::endForm();?>
<?php
	Yii::app()->clientScript->registerScript('js', "
		var getPart = function(i){
			var part = '<fieldset class=\"part\"><legend>项目信息</legend>';
			part += '<div class=\'remove\'>删除项目信息×</div><div class=\"row\">';
			part += '<label for=\"Name_'+i+'\">项目名称<span class=\"required\">*</span></label>';
			part += '<input id=\"Name_'+i+'\" class=\"name\" type=\"text\" value=\"\" name=\"RProForm[Name][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"Role_'+i+'\">担任角色<span class=\"required\">*</span></label>';
			part += '<input id=\"Role_'+i+'\" class=\"role\" type=\"text\" value=\"\" name=\"RProForm[Role][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"Introduction_'+i+'\">项目简介<span class=\"required\">*</span></label>';
			part += '<input id=\"Introduction_'+i+'\" class=\"introduction\" type=\"text\" value=\"\" name=\"RProForm[Introduction][]\"/>';
			part += '</div><div class=\"row\">';
			part += '<label for=\"Content_'+i+'\">个人贡献<span class=\"required\">*</span></label>';
			part += '<textarea id=\"Content_'+i+'\" class=\"content\" name=\"RProForm[Content][]\"></textarea>';
			part += '</div></fieldset>';
			return part;
		}

		var i = 2;
		$('#addpro').click(function(){
			$('.part:last').after(getPart(i++));
			return false;
		});

		$(document).on('click','.remove',function(){
			if($('.part').length <= 1){
				alert('项目信息不能为空.');
			}
			else{
				$(this).parent().remove();
			}
		});
	",CClientScript::POS_READY);
?>
