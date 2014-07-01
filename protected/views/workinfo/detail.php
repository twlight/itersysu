<?php
$workinfo = Workinfo::model()->findByPk($workinfoDetail->WorkinfoId);
$company = Company::model()->findByPk($workinfo->CompanyId);
$this->pageTitle=Yii::app()->name . ' - '.$workinfoDetail->WorkName;
$this->breadcrumbs=array(
	$company->CompanyName=>array('workinfo/index','id'=>$workinfo->Id),
	$workinfoDetail->WorkName,
);
?>

<div class="jobbox">
	<div class="jobbox-title">
		<div class="jobbox-name">
			<p><?php echo $workinfoDetail->WorkName; ?></p>
		</div> 
		<div class="jobbox-name_c">
			<p><?php echo $company->CompanyName; ?></p>
		</div>
	</div>

	<div class="jobbox-body">
		<div class="jobbox-mainbox">
			<ul style="margin-left:20px">
						<li>性别要求： <?php echo Info::getSex($workinfoDetail->Sex); ?></li>
						<li>招聘人数： <?php echo $workinfoDetail->OfferNum == 0 ? '若干' : $workinfoDetail->OfferNum; ?></li>
						<li>年龄要求： <?php echo empty($workinfoDetail->Age) ? '不限' : $workinfoDetail->Age; ?></li>
						<li>雇佣形式： <?php echo Info::getWorkType($workinfoDetail->Type); ?></li>
						<li>截至日期： <?php echo $workinfo->EndTime; ?></li>
						<li>学历要求： <?php echo Info::getEdu_Corp($workinfoDetail->Edu); ?></li>
						<li>薪资待遇： <?php echo $workinfoDetail->Pay == 0 ? '面议' : $workinfoDerail->Pay; ?></li>
						<li>工作经验： <?php echo Info::getExperience_Corp($workinfoDetail->Experience); ?></li>
						<li>工作地点： <?php echo $workinfoDetail->WorkPlace; ?></li>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="jobbox-listbox">
			<div class="com-title">职位描述</div>
			<br/>
			<div class="listbox-text">
				<?php echo $workinfoDetail->Introduction; ?>
			</div>
		</div>
		<div class="jobbox-listbox">
			<div class="com-title">任职条件</div>
			<br/>
			<div class="listbox-text">
				<?php echo $workinfoDetail->Con; ?>
			</div>
		</div>
		<div class="jobbox-listbox">
			<div class="com-title">相关福利</div>
			<br/>
			<div class="listbox-text">
				<?php echo $workinfoDetail->Welfare; ?>
			</div>
		</div>
		<?php if(Yii::app()->user->isGuest || Yii::app()->user->UserType == 0): ?>
		<div class="jobbox-listbox" style='text-align:center;'>
			<div class='btn-group'>
				<?php echo CHtml::link('收藏职位',array('favourite/add','str'=>$workinfoDetail->Id),array('class'=>'btn','id'=>'fav')); ?>
				<?php echo CHtml::link('投递简历','#',array('class'=>'btn btn-primary post','id'=>'resume'.$workinfoDetail->Id)); ?>
			</div>
		</div>
		<?php endif ?>
	</div>
</div>


<div class="modal hide fade" id='post'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>投递简历</h3>
	</div>
	<div class="modal-body">
		<p></p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo Yii::app()->createUrl('resume/select'); ?>" class="btn">新增简历</a>
		<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
		<a href="#" class="btn btn-success" data-dismiss="modal" id="deltopost">投递</a>
	</div>
</div>

<div class="modal hide fade" id='favsuccess'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>收藏成功</h3>
	</div>
	<div class="modal-body">
		<p>收藏成功！</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo Yii::app()->createUrl('favourite/index'); ?>" class="btn">转到“职位收藏夹”</a>
		<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
	</div>
</div>

<div class="modal hide fade" id='postsuccess'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>投递成功</h3>
	</div>
	<div class="modal-body">
		<p>投递成功！</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo Yii::app()->createUrl('resume/sumitted'); ?>" class="btn">转到“已投简历”</a>
		<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
	</div>
</div>

<div class="modal hide fade" id='login'>
	<div class="modal-header">
		<a href="#" class="close" data-dismiss="modal">×</a>
		<h3>登陆</h3>
	</div>
	<div class="modal-body">
		<p>你尚未登陆！</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo Yii::app()->createUrl('site/userReg'); ?>" class="btn">注册</a>
		<a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="btn btn-primary">登陆</a>
	</div>
</div>

<?php
	if(Yii::app()->user->isGuest){
		Yii::app()->clientScript->registerScript('js','
			var login = function(){
				$("#login").modal({
					backdrop:true,
					keyboard:true,
					show:true
				});
			}

			$(document).on("click","#fav",function() {
				login();
				return false;
			});

			$(document).on("click","#post",function(){
				login();
				return false;
			});
		',CClientScript::POS_LOAD);
	}
	else{
		Yii::app()->clientScript->registerScript('js','
			$(document).on("click","#fav",function() {
				$.ajax({
					url:$(this).attr("href"),
					type:"POST",
					success:function(){
						$("#favsuccess").modal({
							backdrop:true,
							keyboard:true,
							show:true
						});
					},
				});
				return false;
			});

			$(document).on("click","a.post",function(){
				id = $(this).attr("id");
				id = id.substring(6);
				$.post("'.Yii::app()->createUrl('resume/getall').'",[],function(data){
					var str = "";
					for(var i=0;i<data.length;i++){
						str += "<input type=\"radio\" name=\"resume\" value=\""+data[i].id+"\" id=\""+data[i].id+"\" class=\"topost\"/>"+"<label for=\""+data[i].id+"\">"+data[i].name+"("+data[i].type+")"+"</label><br/>";
					}
					if(data.length == 0){
						$("#post .modal-body p").html("暂无简历.");
					}
					else{
						$("#post .modal-body p").html(str);
					}
					$("#post").modal({
						backdrop:true,
						keyboard:true,
						show:true
					});
				},"json");
				return false;
			});

			$(document).on("click","#deltopost",function(){
				var r = $(".topost:checked").val();
				if(r){
					$.post("'.Yii::app()->createUrl('resume/post').'"+"&work="+id+"&resume="+r,[],function(){
						$("#postsuccess").modal({
							backdrop:true,
							keyboard:true,
							show:true
						});
					});
				}
			});
		',CClientScript::POS_LOAD);
	}
