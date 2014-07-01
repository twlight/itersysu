<?php
$this->pageTitle=Yii::app()->name . ' - 首页';
?>

<style>  
.out_box{border:1px solid #ccc; background:#fff; font:12px/20px Tahoma;}  
.list_box{border-bottom:1px solid #eee; padding:0 5px; cursor:pointer;}  
.focus_box{background:#f0f3f9;}  
.mark_box{color:#c00;}  
</style>
<div class='center container'>
	<?php
		//if(Yii::app()->user->name == 'Guest'){
	?>
		<!--	<div class='index-left'>
				<img src='<?php //echo Yii::app()->request->baseUrl; ?>/images/index.jpg'/>
			</div>
		-->
	<?php
			/*echo CHtml::openTag('div',array('class'=>'form index-right','style'=>'margin-top:20px;'));
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>true,
				'htmlOptions'=>array(
					'autocomplete'=>'off',
				),
			));
			echo CHtml::tag('h4',array(),'登录');
			echo CHtml::openTag('div',array('class'=>'row'));
			echo $form->labelEx($model,'email');
			echo CHtml::openTag('div',array('class'=>'input-prepend'));
			echo CHtml::tag('span',array('class'=>'add-on'),'<i class="icon-envelope"></i>');
			echo $form->textField($model,'email',array('placeholder'=>'请输入注册邮箱'));
			echo CHtml::closeTag('div');
			echo $form->error($model,'email');
			echo CHtml::closeTag('div');
			echo CHtml::openTag('div',array('class'=>'row'));
			echo $form->labelEx($model,'password');
			echo CHtml::openTag('div',array('class'=>'input-prepend'));
			echo CHtml::tag('span',array('class'=>'add-on'),'<i class="icon-qrcode"></i>');
			echo $form->passwordField($model,'password',array('placeholder'=>'请输入密码'));
			echo CHtml::closeTag('div');
			echo $form->error($model,'password');
			echo CHtml::closeTag('div');
			echo CHtml::openTag('div',array('class'=>'row rememberMe'));
			echo $form->checkBox($model,'rememberMe');
			echo $form->label($model,'rememberMe');
			echo $form->error($model,'rememberMe');
			echo CHtml::closeTag('div');

			echo CHtml::openTag('div',array('class'=>'row submit'));
			echo CHtml::submitButton('登录');

			$this->endWidget();

			echo CHtml::openTag('div',array('style'=>'margin-top:20px;text-align:center;'));
			echo CHtml::openTag('div',array('class'=>'btn-group'));
			echo CHtml::link('求职用户注册',array('site/userReg'),array('class'=>'btn btn-primary'));
			echo CHtml::link('企业用户注册',array('site/comReg'),array('class'=>'btn btn-success'));
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
		}*/
/*
		else if(Yii::app()->user->UserType == 0){
			echo CHtml::openTag('div',array('class'=>'index-right'));
			echo CHtml::openTag('div',array('style'=>'padding-left:30px;padding-top:100px;'));
			echo CHtml::tag('h1',array('style'=>'color:blue;'),Yii::app()->user->Username);
			echo CHtml::tag('h4',array(),Yii::app()->user->Email);
			echo CHtml::tag('p',array('style'=>'color:orange;font-weight:bold;text-align:center;margin:20px 0 0 0'),'拥有一份出色的简历是求职成功的关键!');
			echo CHtml::openTag('p',array('style'=>'text-align:center;'));
			echo CHtml::link('去填写简历',array('resume/create'),array('style'=>'margin-right:10px;'));
			echo CHtml::link('简历管理',array('resume/index'));
			echo CHtml::closeTag('p');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
		}
		else if(Yii::app()->user->UserType == 1){
			echo CHtml::openTag('div',array('class'=>'index-right'));
			echo CHtml::openTag('div',array('style'=>'padding-left:30px;padding-top:100px;'));
			$company = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
			echo CHtml::tag('h1',array('style'=>'color:blue;'),$company->CompanyName);
			echo CHtml::tag('h4',array(),Yii::app()->user->Email);
			if(empty($company->StartYear) || empty($company->RegisteredCapital)){
				echo CHtml::tag('p',array('style'=>'color:orange;font-weight:bold;text-align:center;margin:20px 0 0 0'),'你尚未完善企业信息!');
				echo CHtml::openTag('p',array('style'=>'text-align:center;'));
				echo CHtml::link('完善企业信息',array('corp/edit'),array());
				echo CHtml::closeTag('p');
			}
			else{
				echo CHtml::tag('p',array('style'=>'color:orange;font-weight:bold;text-align:center;margin:20px 0 0 0'),'你已完善企业信息!');
				echo CHtml::openTag('p',array('style'=>'text-align:center;'));
				echo CHtml::link('查看企业信息',array('corp/view'),array());
				echo CHtml::closeTag('p');
			}
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
		}
*/
		//else{
		?>
			<div class="info-body">
				<div id="slider">
					<div class="ad-content">
						<div class='ad-item'>
							<img class="adBanner hideAd" src='<?php echo Yii::app()->request->baseUrl; ?>/images/pic01.jpg' alt="Ad Banner"/>
						</div>
						<div class='ad-item'>
							<img class="adBanner hideAd" src='<?php echo Yii::app()->request->baseUrl; ?>/images/pic02.jpg' alt="Ad Banner"/>
						</div>
						<div class='ad-item'>
							<img class="adBanner hideAd" src='<?php echo Yii::app()->request->baseUrl; ?>/images/pic03.jpg' alt="Ad Banner"/>
						</div>
					</div>
					<div class="ad-action">
						<p>
							<a class="adButton" href="#"></a>
							<a class="adButton" href="#"></a>
							<a class="adButton" href="#"></a>
						</p>
					</div>
				</div>
			</div>
		<?php //} 

		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/assets/mailAutoComplete.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScript('autoMail','
			$("#LoginForm_email").mailAutoComplete({  
				boxClass: "out_box", //外部box样式  
				listClass: "list_box", //默认的列表样式  
				focusClass: "focus_box", //列表选样式中  
				markCalss: "mark_box", //高亮样式  
				autoClass: false,  
				textHint: true, //提示文字自动隐藏  
				hintText: "请输入邮箱地址"  
			});
		',CClientScript::POS_LOAD);
	?>
</div>

<div class='index-info'>
	<h5>最新全职招聘信息</h5>
	<hr/>
	<?php
		$info = Yii::app()->db->createCommand()
							  ->select('d.Id, w.Id as id, d.WorkName, w.CompanyId')
							  ->from(WorkinfoDetail::model()->tableName().' d')
							  ->join(Workinfo::model()->tableName().' w', 'd.WorkinfoId=w.Id')
							  ->where('d.Id IN (SELECT DISTINCT d.Id FROM tb_WorkinfoDetail d) AND w.EndTime>:time AND d.Type=0', array(':time'=>date('Y-m-d H:i:s')))
							  ->order('w.Id DESC')
							  ->limit(20)
							  ->queryAll();
		foreach($info as $item){
			echo CHtml::openTag('div',array('class'=>'work-item'));
			echo CHtml::link($item['WorkName'],array('workinfo/detail','id'=>$item['Id']),array('target'=>'_blank'));
			echo CHtml::openTag('span');
			$company = Company::model()->findByPk($item['CompanyId']);
			echo CHtml::link($company->CompanyName,array('workinfo/index','id'=>$item['id']),array('target'=>'_blank'));
			echo CHtml::closeTag('span');
			echo CHtml::closeTag('div');
		}
	?>
	<div class='clear'></div>
</div>

<div class='index-info'>
	<h5>最新实习招聘信息</h5>
	<hr/>
	<?php
		$info = Yii::app()->db->createCommand()
							  ->select('d.Id, w.Id as id, d.WorkName, w.CompanyId')
							  ->from(WorkinfoDetail::model()->tableName().' d')
							  ->join(Workinfo::model()->tableName().' w', 'd.WorkinfoId=w.Id')
							  ->where('d.Id IN (SELECT DISTINCT d.Id FROM tb_WorkinfoDetail d) AND w.EndTime>:time AND d.Type=1', array(':time'=>date('Y-m-d H:i:s')))
							  ->order('w.Id DESC')
							  ->limit(20)
							  ->queryAll();
		foreach($info as $item){
			echo CHtml::openTag('div',array('class'=>'work-item'));
			echo CHtml::link($item['WorkName'],array('workinfo/detail','id'=>$item['Id']),array('target'=>'_blank'));
			echo CHtml::openTag('span');
			$company = Company::model()->findByPk($item['CompanyId']);
			echo CHtml::link($company->CompanyName,array('workinfo/index','id'=>$item['id']),array('target'=>'_blank'));
			echo CHtml::closeTag('span');
			echo CHtml::closeTag('div');
		}
	?>
	<div class='clear'></div>
</div>

<div class='index-info'>
	<h5>最新兼职招聘信息</h5>
	<hr/>
	<?php
		$info = Yii::app()->db->createCommand()
							  ->select('d.Id, w.Id as id, d.WorkName, w.CompanyId')
							  ->from(WorkinfoDetail::model()->tableName().' d')
							  ->join(Workinfo::model()->tableName().' w', 'd.WorkinfoId=w.Id')
							  ->where('d.Id IN (SELECT DISTINCT d.Id FROM tb_WorkinfoDetail d) AND w.EndTime>:time AND d.Type=2', array(':time'=>date('Y-m-d H:i:s')))
							  ->order('w.Id DESC')
							  ->limit(20)
							  ->queryAll();
		foreach($info as $item){
			echo CHtml::openTag('div',array('class'=>'work-item'));
			echo CHtml::link($item['WorkName'],array('workinfo/detail','id'=>$item['Id']),array('target'=>'_blank'));
			echo CHtml::openTag('span');
			$company = Company::model()->findByPk($item['CompanyId']);
			echo CHtml::link($company->CompanyName,array('workinfo/index','id'=>$item['id']),array('target'=>'_blank'));
			echo CHtml::closeTag('span');
			echo CHtml::closeTag('div');
		}
	?>
	<div class='clear'></div>
</div>
