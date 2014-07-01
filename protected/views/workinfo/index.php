<?php
$company = Company::model()->findByPk($workinfo->CompanyId);
$this->pageTitle=Yii::app()->name . ' - '.$company->CompanyName;
$this->breadcrumbs=array(
	$company->CompanyName,
);
?>

<div class="combox-name">
	<div class="com-name"><?php echo $company->CompanyName; ?></div>
</div>

<div class="combox-body">
	<ul class="combox-mainbox">
		<li>成立年份: <?php echo $company->StartYear; ?></li>
		<li>注册资金: <?php echo $company->RegisteredCapital; ?>万元</li>
		<li>公司网址: <?php echo $company->Url; ?></li>
		<li>公司规模: <?php echo Info::getScope($company->Scope); ?></li>
		<li>公司类型: <?php echo Info::getCompanyType($company->Type); ?></li>
		<li>公司行业: <?php echo Info::getBusinessType($company->BusinessTypeId); ?></li>
		<li>联系人: <?php echo $workinfo->Hr; ?></li>
		<li>Email: <?php echo $workinfo->Email; ?></li>
		<li>联系电话: <?php echo $workinfo->Tel; ?></li>
		<li>截至时间: <?php echo $workinfo->EndTime; ?></li>
	</ul>
	<div class="clear" style="border-bottom: 1px dashed #CFCFCF; padding: 20px 0 0 0; margin: 0 20px 0 20px;"></div>
	<div class="com-title">公司简介</div>
	<div class="com-detail"><?php echo $company->Introduction; ?></div>
	<div class="clear" style="border-bottom: 1px dashed #CFCFCF; padding: 20px 0 0 0; margin: 0 20px 0 20px;"></div>	
<!--<h3>招聘简介</h3>
<p><?php //echo $workinfo->Introduction; ?></p>-->
	<div class="com-detail-title">
		<div>招聘职位</div>
	</div>
<table>
	<thead>
		<tr>
			<th>职位名称</th>
			<th>招聘人数</th>
			<th>学历要求</th>
			<th>工作经验</th>
			<th>工作地点</th>
			<th>薪酬待遇</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$workinfoDetail = WorkinfoDetail::model()->findAll('WorkinfoId=:WorkinfoId',array(':WorkinfoId'=>$workinfo->Id));
			foreach($workinfoDetail as $item){
				echo CHtml::openTag('tr');
				echo CHtml::openTag('td');
				echo CHtml::link($item->WorkName,array('workinfo/detail','id'=>$item->Id),array());
				echo CHtml::closeTag('td');
				echo CHtml::tag('td',array(),$item->OfferNum == 0 ? '若干' : $item->OfferNum);
				echo CHtml::tag('td',array(),Info::getEdu_Corp($item->Edu));
				echo CHtml::tag('td',array(),Info::getExperience_Corp($item->Experience));
				echo CHtml::tag('td',array(),$item->WorkPlace);
				echo CHtml::tag('td',array(),$item->Pay == 0 ? '面议' : $item->Pay);
				echo CHtml::closeTag('tr');
			}
		?>
	</tbody>
</table>
</div>
