<?php
	$this->pageTitle=Yii::app()->name . ' - 职位搜索';

	function delQueryFromUrl($url, $str){
		$arr = parse_url($url);
		$query = $arr['query'];
		$q_arr = split('&',$query);
		$new_query = '';
		foreach($q_arr as $item){
			$tmp = split('=',$item);
			if($tmp[0] != $str){
				if(!empty($new_query)){
					$new_query.='&';
				}
				$new_query.=$item;
			}
		}
		return $arr['path'].'?'.$new_query;
	}

	$sourceUrl = Yii::app()->createUrl('job/search');
	if($key != null){
		$sourceUrl .= '&key='.$key;
	}
	$selected = false;
	if(!empty($bt)){
		$sourceUrl.='&bt='.$bt;
		$selected = true;
	}
	if(!empty($subbt)){
		$sourceUrl.='&subbt='.$subbt;
		$selected = true;
	}
	if(!empty($place)){
		$sourceUrl.='&place='.$place;
		$selected = true;
	}
	if(!empty($subplace)){
		$sourceUrl.='&subplace='.$subplace;
		$selected = true;
	}
	if(!empty($time)){
		$sourceUrl.='&time='.$time;
		$selected = true;
	}
	if(!empty($pay)){
		$sourceUrl.='&pay='.$pay;
		$selected = true;
	}
	if($type != null){
		$sourceUrl.='&type='.$type;
		$selected = true;
	}
	if($worktype != null){
		$sourceUrl.='&worktype='.$worktype;
		$selected = true;
	}

	echo CHtml::openTag('div',array('id'=>'select'));
	echo CHtml::openTag('div',array('id'=>'select-head'));
	echo CHtml::tag('p',array(),'筛选');
	echo CHtml::closeTag('div');
	if($selected){
		echo CHtml::openTag('div',array('class'=>'select-parent'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('已选条件：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		if(!empty($bt)){
			$url = delQueryFromUrl($sourceUrl,'bt');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'职位：');
			$BusinessType = BusinessType::model()->find('Id=:Id',array(':Id'=>$bt));
			echo CHtml::tag('span',array('class'=>'select-selected-s'),$BusinessType->Name.' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if(!empty($subbt)){
			$url = delQueryFromUrl($sourceUrl,'subbt');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'职位子类：');
			$BusinessType = BusinessType::model()->find('Id=:Id',array(':Id'=>$subbt));
			echo CHtml::tag('span',array('class'=>'select-selected-s'),$BusinessType->Name.' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if(!empty($place)){
			$url = delQueryFromUrl($sourceUrl,'place');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'公司所在地：');
			$p = Place::model()->find('Id=:Id',array(':Id'=>$place));
			echo CHtml::tag('span',array('class'=>'select-selected-s'),$p->Name.' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if(!empty($subplace)){
			$url = delQueryFromUrl($sourceUrl,'subplace');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'地区子类：');
			$p = Place::model()->find('Id=:Id',array(':Id'=>$subplace));
			echo CHtml::tag('span',array('class'=>'select-selected-s'),$p->Name.' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if(!empty($time)){
			$url = delQueryFromUrl($sourceUrl,'time');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'发布时间：');
			echo CHtml::tag('span',array('class'=>'select-selected-s'),Info::getPublishTime($time).' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if(!empty($pay)){
			$url = delQueryFromUrl($sourceUrl,'pay');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'工资：');
			echo CHtml::tag('span',array('class'=>'select-selected-s'),Info::getSelectPay($pay).' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if($type != null){
			$url = delQueryFromUrl($sourceUrl,'type');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'公司性质：');
			echo CHtml::tag('span',array('class'=>'select-selected-s'),Info::getCompanyType($type).' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		if($worktype != null){
			$url = delQueryFromUrl($sourceUrl,'worktype');
			echo CHtml::openTag('a',array('href'=>$url,'class'=>'sort'));
			echo CHtml::openTag('div',array('class'=>'select-selected'));
			echo CHtml::tag('span',array(),'工作性质：');
			echo CHtml::tag('span',array('class'=>'select-selected-s'),Info::getWorkType($worktype).' ×');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('a');
		}
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}
	if(empty($bt)){
		echo CHtml::openTag('div',array('class'=>'select-parent'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('职位：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		$BusinessType = BusinessType::model()->findAll('ParentId=0');
		foreach($BusinessType as $item){
			echo CHtml::openTag('div',array('class'=>'select-item'));
			echo CHtml::link($item->Name,$sourceUrl.'&bt='.$item->Id,array('class'=>'sort'));
			echo CHtml::closeTag('div');
		}
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}
	else if(empty($subbt)){
		echo CHtml::openTag('div',array('class'=>'select-parent'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('职位子类：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		$BusinessType = BusinessType::model()->findAll('ParentId=:Id',array(':Id'=>$bt));
		foreach($BusinessType as $item){
			echo CHtml::openTag('div',array('class'=>'select-item'));
			echo CHtml::link($item->Name,$sourceUrl.'&subbt='.$item->Id,array('class'=>'sort'));
			echo CHtml::closeTag('div');
		}
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}

	if(empty($place)){
		echo CHtml::openTag('div',array('class'=>'select-parent'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('公司所在地：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		$Place = Place::model()->findAll('ParentId=0');
		foreach($Place as $item){
			echo CHtml::openTag('div',array('class'=>'select-item'));
			echo CHtml::link($item->Name,$sourceUrl.'&place='.$item->Id,array('class'=>'sort'));
			echo CHtml::closeTag('div');
		}
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}
	else if(empty($subplace)){
		echo CHtml::openTag('div',array('class'=>'select-parent'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('地区子类：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		$place = Place::model()->findAll('ParentId=:Id',array(':Id'=>$place));
		foreach($place as $item){
			echo CHtml::openTag('div',array('class'=>'select-item'));
			echo CHtml::link($item->Name,$sourceUrl.'&subplace='.$item->Id,array('class'=>'sort'));
			echo CHtml::closeTag('div');
		}
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}

	if(empty($time)){
		echo CHtml::openTag('div',array('class'=>'select-parent tohide'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('发布时间：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('3天内',$sourceUrl.'&time=1',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('1周内',$sourceUrl.'&time=2',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('2周内',$sourceUrl.'&time=3',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('1月内',$sourceUrl.'&time=4',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('3月内',$sourceUrl.'&time=5',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}

	if(empty($pay)){
		echo CHtml::openTag('div',array('class'=>'select-parent tohide'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('工资：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('面议',$sourceUrl.'&pay=1',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('1000-2000元/月',$sourceUrl.'&pay=2',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('2000-3000元/月',$sourceUrl.'&pay=3',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('3000-5000元/月',$sourceUrl.'&pay=4',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('5000-8000元/月',$sourceUrl.'&pay=5',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('8000-10000元/月',$sourceUrl.'&pay=6',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('10000-20000元/月',$sourceUrl.'&pay=7',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('2万元以上/月',$sourceUrl.'&pay=8',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}

	if($type == null){
		echo CHtml::openTag('div',array('class'=>'select-parent tohide'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('公司性质：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('民营企业',$sourceUrl.'&type=0',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('国有企业',$sourceUrl.'&type=1',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('中外合资企业',$sourceUrl.'&type=2',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('外商独资企业',$sourceUrl.'&type=3',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('股份制企业',$sourceUrl.'&type=4',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('上市公司',$sourceUrl.'&type=5',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('国家机关',$sourceUrl.'&type=6',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('事业单位',$sourceUrl.'&type=7',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('其他',$sourceUrl.'&type=8',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}

	if($worktype == null){
		echo CHtml::openTag('div',array('class'=>'select-parent tohide'));
		echo CHtml::openTag('div',array('class'=>'select-key'));
		echo CHtml::encode('工作性质：');
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-items'));
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('全职',$sourceUrl.'&worktype=0',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('实习',$sourceUrl.'&worktype=1',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array('class'=>'select-item'));
		echo CHtml::link('兼职',$sourceUrl.'&worktype=2',array('class'=>'sort'));
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
	}
	echo CHtml::closeTag('div');
	/*echo CHtml::openTag('div',array('class'=>'select-more'));
	echo CHtml::openTag('div',array());
	echo CHtml::encode('更多选项');
	echo CHtml::tag('b',array(),'');
	echo CHtml::closeTag('div');
	echo CHtml::closeTag('div');*/

	if(Yii::app()->user->isGuest || Yii::app()->user->UserType == 0 || Yii::app()->user->UserType == 2){
		$templateStr = '{summary}{sorter}<div class="search-head"><div class="search-checkbox">全选</div><div class="search-batch">批量操作：<a href="#" id="postall">投递简历</a> <a href="#" id="favall">收藏职位</a></div></div><div class="search-header"><div class="search-checkbox"><input type="checkbox" style="margin:0px;" id="chk-all"/></div><div class="search-workname">职位名称</div><div class="search-corpname">公司名称</div><div class="search-place">招聘地点</div><div class="search-posttime">发布时间</div></div>{items}{pager}';
	}
	else{
		$templateStr = '{summary}{sorter}<div class="search-head"><div class="search-checkbox">全选</div><div class="search-batch">批量操作：无 </div></div><div class="search-header"><div class="search-checkbox"><input type="checkbox" style="margin:0px;" id="chk-all"/></div><div class="search-workname">职位名称</div><div class="search-corpname">公司名称</div><div class="search-place">招聘地点</div><div class="search-posttime">发布时间</div></div>{items}{pager}';
	}

	$this->widget('zii.widgets.CListView', array(
		'id'=>'result-list',
		'dataProvider'=>$dataProvider,
		'itemView'=>'_items',   // refers to the partial view named '_post'
		'emptyText'=>'暂时没有数据',    
		'enableSorting'=>true,
		'enablePagination'=>true,
		'sortableAttributes'=>array(
			'PostTime'=>'更新时间',
			'Pay'=>'工资',
		),
		'template'=>$templateStr,
	));

	if(Yii::app()->user->isGuest){
		Yii::app()->clientScript->registerScript('js','
			var login = function(){
				$("#login").modal({
					backdrop:true,
					keyboard:true,
					show:true
				});
			}

			$(document).on("click","a.fav",function() {
				login();
				return false;
			});

			$(document).on("click","#favall",function(){
				login();
				return false;
			});

			$(document).on("click",".post",function(){
				login();
				return false;
			});

			$(document).on("click","#postall",function(){
				login();
				return false;
			});
		',CClientScript::POS_LOAD);
	}
	else{
		Yii::app()->clientScript->registerScript('js','
			$(document).on("click","a.fav",function() {
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

			$(document).on("click","#favall",function(){
				var str = "";
				$(".items input[type=\'checkbox\']").each(function(){
					if($(this).is(":checked"))
						str+=$(this).attr("id")+","
				});
				str = str.substr(0,str.length-1);
				var url = "'.Yii::app()->createUrl('favourite/add').'";
				$.ajax({
					url:url+"&str="+str,
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

			$(document).on("click",".post",function(){
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

			$(document).on("click","#postall",function(){
				var str = "";
				$(".items input[type=\'checkbox\']").each(function(){
					if($(this).is(":checked"))
						str+=$(this).attr("id")+","
				});
				str = str.substr(0,str.length-1);
				id = str;
				$.post("'.Yii::app()->createUrl('resume/getall').'",[],function(data){
					var str = "";
					for(var i=0;i<data.length;i++){
						str += "<input type=\"radio\" name=\"resume\" value=\""+data[i].id+"\" id=\""+data[i].id+"\" class=\"topost\"/>"+"<label for=\""+data[i].id+"\">"+data[i].name+"("+data[i].type+")"+"</label><br/>";
					}
					$("#post .modal-body p").html(str);
					$("#post").modal({
						backdrop:true,
						keyboard:true,
						show:true
					});
				},"json");
				return false;
			});
		',CClientScript::POS_LOAD);
	}
	Yii::app()->clientScript->registerScript('js2','
		$(document).on("click",".sort",function(){
			var u = $(this).attr("href");
			$.ajax({
				url : u,
				dataType : "html",
				success: function(data) {
					$("#select").html($(data).find("#select").html());
				},
				error : function() {
					alert("Sorry, The requested property could not be found.");
				}
			});
			$.fn.yiiListView.update("result-list", {
				url: u,
			});
			return false;
		});

		$(document).on("click","#chk-all",function(){
			if($(this).is(":checked")){
				$(".items input[type=\'checkbox\']").attr("checked",true);
			}
			else{
				$(".items input[type=\'checkbox\']").attr("checked",false);
			}
		});

		$(document).on("click",".search-item",function(){
			if($(this).children(".search-checkbox2").children("input").is(":checked")){
				$(this).children(".search-checkbox2").children("input").attr("checked",false);
			}
			else{
				$(this).children(".search-checkbox2").children("input").attr("checked",true);
			}
		});

		$(".select-more").click(function(){
			if($(".tohide").hasClass("hide")){
				$(".tohide").removeClass("hide");
				$(".select-more div").html("收起<b class=\"open\"></b>");
			}
			else{
				$(".tohide").addClass("hide");
				$(".select-more div").html("更多选项<b></b>");
			}
		});
	',CClientScript::POS_LOAD);
?>

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
		<a href="<?php echo Yii::app()->createUrl('resume/submitted'); ?>" class="btn">转到“已投简历”</a>
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
