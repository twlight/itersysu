<?php
$this->pageTitle=Yii::app()->name . ' - '.$model->CompanyName;
$this->breadcrumbs=array(
	$model->CompanyName,
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>查看企业信息</p>
		</div>
	</div>
	
	<div class="com-user-box">
		<table width="100%" border="0" cellpadding="4" cellspacing="0" style="margin-top: 10px;">
			<tbody>
				<tr>
					<td width="60" height="30" align="right">公司名称</td>
					<td><?php echo $model->CompanyName; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">建立年份</td>
					<td><?php echo $model->StartYear; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">注册资金</td>
					<td><?php echo $model->RegisteredCapital; ?>万元</td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">公司规模</td>
					<td><?php echo Info::getScope($model->Scope); ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">公司类型</td>
					<td><?php echo Info::getCompanyType($model->Type); ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">所属行业</td>
					<td><?php echo Info::getBusinessType($model->BusinessTypeId); ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">公司网址</td>
					<td><?php echo $model->Url; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">所属地区</td>
					<td><?php echo Info::getPlace($model->PlaceId); ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">公司标识</td>
					<td><?php echo $model->Img; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">Email</td>
					<td><?php echo $model->Email; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">联系电话</td>
					<td><?php echo $model->Tel; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">联系地址</td>
					<td><?php echo $model->Address; ?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="com-user-box">
		<div class="titbox">
			<p>公司简介：</p>
		</div>
		<p style='padding:10px;margin:0px;text-indent:2em;'><?php echo $model->Introduction; ?></p>
	</div>
</div>
