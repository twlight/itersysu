<?php
$this->pageTitle=Yii::app()->name . ' - 账户信息';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'账户信息',
);
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>账户信息</p>
		</div>
	</div>
	<div class="com-user-box">
		<table width="100%" border="0" cellpadding="4" cellspacing="0" style="margin-top: 10px;">
			<tbody>
				<tr>
					<td width="60" height="30" align="right">Email</td>
					<td><?php echo $model->Email; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">用户名</td>
					<td><?php echo $model->Username; ?></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">密码</td>
					<td><a href='<?php Yii::app()->createUrl('my/changepw'); ?>'>修改密码</a></td>
				</tr>
				<tr>
					<td width="60" height="30" align="right">用户类型</td>
					<td><?php
						if($model->UserType == 0){
							echo "求职用户";
						}
						else if($model->UserType == 1){
							echo "企业用户";
						}
						else if($model->UserType == 2){
							echo "管理用户";
						}
					?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
