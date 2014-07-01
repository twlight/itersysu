<?php

class ApiController extends Controller
{
	public $layout='column1';

	public function filters(){
		return array(
			'accessControl',
		);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('search','login','resumebase','resumeedu','resumeproject','resumeexperience'),
				'users'=>array('*'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionSearch($key=null, $bt=null, $subbt=null, $place=null, $page=1){
		if(!empty($key)){
			$key = urldecode($key);
		}
		$model = new SearchApi;
		$model->items = array();
		if(!empty($bt)){
			$businesstype = BusinessType::model()->findByPk($bt);
			if(empty($businesstype) || $businesstype->ParentId !=0){
				$model->code = 400;
				$model->error = "Error business type!";
				echo json_encode($model);
				exit;
			}
		}
		if(!empty($subbt)){
			$subbusinesstype = BusinessType::model()->findByPk($subbt);
			if(empty($subbusinesstype) || $subbusinesstype->ParentId == 0){
				$model->code = 400;
				$model->error = "Error subbusiness type!";
				echo json_encode($model);
				exit;
			}
		}
		if(!empty($place)){
			$p = Place::model()->findByPk($place);
			if(empty($p)){
				$model->code = 400;
				$model->error = "Error place!";
				echo json_encode($model);
				exit;
			}
		}
		$page = intval($page);
		if($page < 1){
			$model->code = 400;
			$model->error = "Error page number!";
			echo json_encode($model);
			exit;
		}

		$data = array();
		$workinfo = Workinfo::model()->findAll();
		foreach($workinfo as $item){
			$criteria=new CDbCriteria;
			$criteria->addCondition("WorkinfoId=$item->Id");
			if($key != null){
				$criteria->addCondition('Introduction LIKE "%'.$key.'%" OR WorkName LIKE "%'.$key.'%" OR Welfare LIKE "%'.$key.'%" OR Con LIKE "%'.$key.'%"');
			}
			$detail = WorkinfoDetail::model()->findAll($criteria);
			foreach($detail as $i){
				$add = true;
				$tmp = array();
				$tmp['WorkName'] = $i->WorkName;
				$company = Company::model()->findByPk($item->CompanyId);
				if(!empty($bt)){
					if($businesstype->ParentId != 0){
						$businesstype = BusinessType::model()->findByPk($businesstype->ParentId);
					}
					if($businesstype->Id != $bt){
						$add = false;
					}
				}
				if(!empty($subbt)){
					$subbusinesstype = BusinessType::model()->findByPk($company->BusinessTypeId);
					if($subbusinesstype->Id != $subbt){
						$add = false;
					}
				}
				if(!empty($place)){
					if($p->Id != $place){
						$add = false;
					}
				}
				$tmp['CompanyName'] = $company->CompanyName;
				$tmp['WorkPlace'] = $i->WorkPlace;
				$bt2 = BusinessType::model()->findByPk($company->BusinessTypeId);
				if($bt2->ParentId == 0){
					$tmp['BusinessType'] = $bt2->Name;
					$tmp['SubBusinessType'] = null;
				}
				else{
					$tmp2 = $bt2->Name;
					$bt2 = BusinessType::model()->findByPk($bt2->ParentId);
					$tmp['BusinessType'] = $bt2->Name;
					$tmp['SubBusinessType'] = $tmp2;
				}
				$tmp['OfferNum'] = $i->OfferNum;
				$tmp['Pay'] = $i->Pay == 0 ? '面议' : $i->Pay.'元';
				$tmp['CompanyType'] = Info::getCompanyType($company->Type);
				$tmp['Experience'] = Info::getExperience_Corp($i->Experience);
				$tmp['Edu'] = Info::getEdu_Corp($i->Edu);
				$tmp['Introduction'] = $i->Introduction;
				if($add){
					array_push($data,$tmp);
				}
			}
		}
		$c = ceil(count($data)/10);
		if($page > $c){
			$page = $c;
		}
		$down = $page*10-10;
		$up = $page*10-1;
		if($up >= count($data)){
			$up = count($data)-1;
		}
		$data2 = array();
		for($i=$down;$i<=$up;$i++){
			array_push($data2,$data[$i]);
		}
		$model->code = 200;
		$model->page = $page;
		$model->count = count($data2);
		$model->items = $data2;
		$model->error = null;
		echo json_encode($model);
		//var_dump($data);
	}

	public function actionLogin(){
		$email = null;
		$password = null;
		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}
		if(isset($_POST['password'])){
			$password = $_POST['password'];
		}
		if($email == null || $password == null){
			$model = new LoginApi;
			$model->code = '400';
			$model->error = 'Email or Password can\'t not be null!';
			echo json_encode($model);
			exit;
		}
		$user = User::model()->find('Email=:Email',array(':Email'=>$email));
		if(empty($user)){
			$model = new LoginApi;
			$model->code = '400';
			$model->error = 'Email does not exists!';
			echo json_encode($model);
			exit;
		}
		if($password == $user->Password){
			$model = new LoginApi;
			$model->code = '200';
			$model->error = '';
			echo json_encode($model);
			exit;
		}
		else{
			$model = new LoginApi;
			$model->code = '400';
			$model->error = 'Email or password error!';
			echo json_encode($model);
			exit;
		}
	}

	public function actionResumebase(){
		$email = null;
		$password = null;
		$Name = null;
		$Username = null;
		$Birth = null;
		$Sex = null;
		$Marrage = null;
		$Hukou = null;
		$Address = null;
		$Edu = null;
		$Experience = null;
		$Tel = null;
		$Email = null;
		$QQ = null;
		$Url = null;
		$Hobby = null;
		$Awarded = null;
		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}
		if(isset($_POST['password'])){
			$password = $_POST['password'];
		}
		if(isset($_POST['Name'])){
			$Name = $_POST['Name'];
		}
		if(isset($_POST['Username'])){
			$Username = $_POST['Username'];
		}
		if(isset($_POST['Birth'])){
			$Birth = $_POST['Birth'];
		}
		if(isset($_POST['Sex'])){
			$Sex = $_POST['Sex'];
		}
		if(isset($_POST['Marrage'])){
			$Marrage = $_POST['Marrage'];
		}
		if(isset($_POST['Hukou'])){
			$Hukou = $_POST['Hukou'];
		}
		if(isset($_POST['Address'])){
			$Address = $_POST['Address'];
		}
		if(isset($_POST['Edu'])){
			$Edu = $_POST['Edu'];
		}
		if(isset($_POST['Experience'])){
			$Experience = $_POST['Experience'];
		}
		if(isset($_POST['Tel'])){
			$Tel = $_POST['Tel'];
		}
		if(isset($_POST['Email'])){
			$Email = $_POST['Email'];
		}
		if(isset($_POST['QQ'])){
			$QQ = $_POST['QQ'];
		}
		if(isset($_POST['Url'])){
			$Url = $_POST['Url'];
		}
		if(isset($_POST['Hobby'])){
			$Hobby = $_POST['Hobby'];
		}
		if(isset($_POST['Awarded'])){
			$Awarded = $_POST['Awarded'];
		}
		if($email == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Email can not be null!';
			echo json_encode($model);
			exit;
		}
		if($password == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Password can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Name == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Name(The name of the resume) can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Username == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Username can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Birth == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Birth can not be null!';
			echo json_encode($model);
			exit;
		}
		if(strtotime($Birth) === false || strtotime($Birth) === -1){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'The format of the Birth is not correct!';
			echo json_encode($model);
			exit;
		}
		if($Sex == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Sex can not be null!';
			echo json_encode($model);
			exit;
		}
		$Sex = intval($Sex);
		if($Sex != 1 && $Sex != 2){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'The value of the Sex is not valid!';
			echo json_encode($model);
			exit;
		}
		if($Marrage == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Marrage can not be null!';
			echo json_encode($model);
			exit;
		}
		$Marrage = intval($Marrage);
		if($Marrage != 0 && $Marrage != 1 && $Marrage != 2){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'The value of the Marrage is not valid!';
			echo json_encode($model);
			exit;
		}
		if($Address == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Address can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Edu == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Edu can not be null!';
			echo json_encode($model);
			exit;
		}
		$Edu = intval($Edu);
		if($Edu < 0 || $Edu > 6){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'The value of the Edu is not valid!';
			echo json_encode($model);
			exit;
		}
		if($Experience == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Experience can not be null!';
			echo json_encode($model);
			exit;
		}
		$Experience = intval($Experience);
		if($Experience < 0 || $Experience > 6){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'The value of the Experience is not valid!';
			echo json_encode($model);
			exit;
		}
		if($Tel == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Tel can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Email == null){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Email can not be null!';
			echo json_encode($model);
			exit;
		}
		$user = User::model()->find('Email=:Email',array(':Email'=>$email));
		if(empty($user)){
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = 'Email does not exists!';
			echo json_encode($model);
			exit;
		}
		if($password != $user->Password){
			$model = new RBaseApi;
			$model->code = '403';
			$model->id = null;
			$model->error = 'Email or password error!';
			echo json_encode($model);
			exit;
		}
		$Resume = new ResumeMain;
		$Resume->Name = $Name;
		$Resume->Secret = 0;
		$Resume->Username = $Username;
		$Resume->Birth = date('Y-m-d',strtotime($Birth));
		$Resume->Sex = $Sex;
		$Resume->Marrage = $Marrage;
		$Resume->Hukou = $Hukou;
		$Resume->Address = $Address;
		$Resume->Edu = $Edu;
		$Resume->Experience = $Experience;
		$Resume->Tel = $Tel;
		$Resume->Email = $Email;
		$Resume->QQ = $QQ;
		$Resume->Url = $Url;
		$Resume->Hobby = $Hobby;
		$Resume->Awarded = $Awarded;
		if($Resume->save()){
			$model = new RBaseApi;
			$model->code = '200';
			$model->id = $Resume->Id;
			$model->error = '';
			echo json_encode($model);
		}
		else{
			$model = new RBaseApi;
			$model->code = '400';
			$model->id = null;
			$model->error = $Resume->getErrors();
			echo json_encode($model);
		}
	}

	public function actionResumeedu(){
		$email = null;
		$password = null;
		$ResumeId = null;
		$StartDate = null;
		$EndDate = null;
		$SchoolName = null;
		$SpecialtyName = null;
		$Edu = null;
		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}
		if(isset($_POST['password'])){
			$password = $_POST['password'];
		}
		if(isset($_POST['ResumeId'])){
			$ResumeId = $_POST['ResumeId'];
		}
		if(isset($_POST['StartDate'])){
			$StartDate = $_POST['StartDate'];
		}
		if(isset($_POST['EndDate'])){
			$EndDate = $_POST['EndDate'];
		}
		if(isset($_POST['SchoolName'])){
			$SchoolName = $_POST['SchoolName'];
		}
		if(isset($_POST['SpecialtyName'])){
			$SpecialtyName = $_POST['SpecialtyName'];
		}
		if(isset($_POST['Edu'])){
			$Edu = $_POST['Edu'];
		}
		if($email == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Email can not be null!';
			echo json_encode($model);
			exit;
		}
		if($password == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Password can not be null!';
			echo json_encode($model);
			exit;
		}
		if($ResumeId == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'ResumeId can not be null!';
			echo json_encode($model);
			exit;
		}
		$resumeMain = ResumeMain::model()->findByPk($ResumeId);
		if(empty($resumeMain)){
			$model = new Api;
			$model->code = '400';
			$model->error = 'ResumeId is error!';
			echo json_encode($model);
			exit;
		}
		if($StartDate == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'StartDate can not be null!';
			echo json_encode($model);
			exit;
		}
		if(strtotime($StartDate) === false || strtotime($StartDate) === -1){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The format of the StartDate is not correct!';
			echo json_encode($model);
			exit;
		}
		if($EndDate == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'EndDate can not be null!';
			echo json_encode($model);
			exit;
		}
		if(strtotime($EndDate) === false || strtotime($EndDate) === -1){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The format of the EndDate is not correct!';
			echo json_encode($model);
			exit;
		}
		if($SchoolName == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'SchoolName can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Edu == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Edu can not be null!';
			echo json_encode($model);
			exit;
		}
		$Edu = intval($Edu);
		if($Edu < 0 || $Edu > 8){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The value Edu is not valid!';
			echo json_encode($model);
			exit;
		}
		$user = User::model()->find('Email=:Email',array(':Email'=>$email));
		if(empty($user)){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Email does not exists!';
			echo json_encode($model);
			exit;
		}
		if($password != $user->Password){
			$model = new Api;
			$model->code = '403';
			$model->error = 'Email or password error!';
			echo json_encode($model);
			exit;
		}
		$resume = Resume::model()->find('ResumeMainId=:Id',array(':Id'=>$resumeMain->Id));
		if($resume->UserId != $user->Id){
			$model = new Api;
			$model->code = '403';
			$model->error = 'Access deny!The Id of the Resume is not yours!';
			echo json_encode($model);
			exit;
		}
		$REdu = new REdu;
		$REdu->ResumeMainId = $resumeMain->Id;
		$REdu->StartDate = date('Y-m-d',strtotime($StartDate));
		$REdu->EndDate = date('Y-m-d',strtotime($EndDate));
		$REdu->SchoolName = $SchoolName;
		$REdu->SpecialtyName = $SpecialtyName;
		$REdu->Edu = $Edu;
		if($REdu->save()){
			$model = new Api;
			$model->code = '200';
			$model->error = '';
			echo json_encode($model);
		}
		else{
			$model = new Api;
			$model->code = '400';
			$model->error = $REdu->getErrors();
			echo json_encode($model);
		}
	}

	public function actionResumeproject(){
		$email = null;
		$password = null;
		$ResumeId = null;
		$Name = null;
		$Role = null;
		$Introduction = null;
		$Content = null;
		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}
		if(isset($_POST['password'])){
			$password = $_POST['password'];
		}
		if(isset($_POST['ResumeId'])){
			$ResumeId = $_POST['ResumeId'];
		}
		if(isset($_POST['Name'])){
			$Name = $_POST['Name'];
		}
		if(isset($_POST['Role'])){
			$Role = $_POST['Role'];
		}
		if(isset($_POST['Introduction'])){
			$Introduction = $_POST['Introduction'];
		}
		if(isset($_POST['Content'])){
			$Content = $_POST['Content'];
		}
		if($email == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Email can not be null!';
			echo json_encode($model);
			exit;
		}
		if($password == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Password can not be null!';
			echo json_encode($model);
			exit;
		}
		if($ResumeId == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'ResumeId can not be null!';
			echo json_encode($model);
			exit;
		}
		$resumeMain = ResumeMain::model()->findByPk($ResumeId);
		if(empty($resumeMain)){
			$model = new Api;
			$model->code = '400';
			$model->error = 'ResumeId is error!';
			echo json_encode($model);
			exit;
		}
		if($Name == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Name can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Role == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Role can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Introduction == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Introduction can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Content == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Content can not be null!';
			echo json_encode($model);
			exit;
		}
		$user = User::model()->find('Email=:Email',array(':Email'=>$email));
		if(empty($user)){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Email does not exists!';
			echo json_encode($model);
			exit;
		}
		if($password != $user->Password){
			$model = new Api;
			$model->code = '403';
			$model->error = 'Email or password error!';
			echo json_encode($model);
			exit;
		}
		$resume = Resume::model()->find('ResumeMainId=:Id',array(':Id'=>$resumeMain->Id));
		if($resume->UserId != $user->Id){
			$model = new Api;
			$model->code = '403';
			$model->error = 'Access deny!The Id of the Resume is not yours!';
			echo json_encode($model);
			exit;
		}
		$RProject = new RProject;
		$RProject->ResumeMainId = $resumeMain->Id;
		$RProject->Name = $Name;
		$RProject->Role = $Role;
		$RProject->Introduction = $Introduction;
		$RProject->Content = $Content;
		if($RProject->save()){
			$model = new Api;
			$model->code = '200';
			$model->error = '';
			echo json_encode($model);
		}
		else{
			$model = new Api;
			$model->code = '400';
			$model->error = $RProject->getErrors();
			echo json_encode($model);
		}
	}

	public function actionResumeexperience(){
		$email = null;
		$password = null;
		$ResumeId = null;
		$StartDate = null;
		$EndDate = null;
		$CompanyName = null;
		$Type = null;
		$CompanyType = null;
		$CompanyScope = null;
		$PostName = null;
		$WorkContent = null;
		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}
		if(isset($_POST['password'])){
			$password = $_POST['password'];
		}
		if(isset($_POST['ResumeId'])){
			$ResumeId = $_POST['ResumeId'];
		}
		if(isset($_POST['StartDate'])){
			$StartDate = $_POST['StartDate'];
		}
		if(isset($_POST['EndDate'])){
			$EndDate = $_POST['EndDate'];
		}
		if(isset($_POST['CompanyName'])){
			$CompanyName = $_POST['CompanyName'];
		}
		if(isset($_POST['Type'])){
			$Type = $_POST['Type'];
		}
		if(isset($_POST['CompanyType'])){
			$CompanyType = $_POST['CompanyType'];
		}
		if(isset($_POST['CompanyScope'])){
			$CompanyScope = $_POST['CompanyScope'];
		}
		if(isset($_POST['PostName'])){
			$PostName = $_POST['PostName'];
		}
		if(isset($_POST['WorkContent'])){
			$WorkContent = $_POST['WorkContent'];
		}
		if($email == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Email can not be null!';
			echo json_encode($model);
			exit;
		}
		if($password == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Password can not be null!';
			echo json_encode($model);
			exit;
		}
		if($ResumeId == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'ResumeId can not be null!';
			echo json_encode($model);
			exit;
		}
		$resumeMain = ResumeMain::model()->findByPk($ResumeId);
		if(empty($resumeMain)){
			$model = new Api;
			$model->code = '400';
			$model->error = 'ResumeId is error!';
			echo json_encode($model);
			exit;
		}
		if($StartDate == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'StartDate can not be null!';
			echo json_encode($model);
			exit;
		}
		if(strtotime($StartDate) === false || strtotime($StartDate) === -1){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The format of the StartDate is not correct!';
			echo json_encode($model);
			exit;
		}
		if($EndDate == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'EndDate can not be null!';
			echo json_encode($model);
			exit;
		}
		if(strtotime($EndDate) === false || strtotime($EndDate) === -1){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The format of the EndDate is not correct!';
			echo json_encode($model);
			exit;
		}
		if($CompanyName == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'CompanyName can not be null!';
			echo json_encode($model);
			exit;
		}
		if($Type == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Type can not be null!';
			echo json_encode($model);
			exit;
		}
		$Type = intval($Type);
		if($Type != 0 && $Type != 1 && $Type != 2){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The value of Type is not value!';
			echo json_encode($model);
			exit;
		}
		if($CompanyType == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'CompanyType can not be null!';
			echo json_encode($model);
			exit;
		}
		$CompanyType = intval($CompanyType);
		if($CompanyType < 0 || $CompanyType > 8){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The value of CompanyType is not value!';
			echo json_encode($model);
			exit;
		}
		if($CompanyScope == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'CompanyScope can not be null!';
			echo json_encode($model);
			exit;
		}
		$CompanyScope = intval($CompanyScope);
		if($CompanyScope < 0 || $CompanyScope > 7){
			$model = new Api;
			$model->code = '400';
			$model->error = 'The value of CompanyScope is not value!';
			echo json_encode($model);
			exit;
		}
		if($PostName == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'PostName can not be null!';
			echo json_encode($model);
			exit;
		}
		if($WorkContent == null){
			$model = new Api;
			$model->code = '400';
			$model->error = 'WorkContent can not be null!';
			echo json_encode($model);
			exit;
		}
		$user = User::model()->find('Email=:Email',array(':Email'=>$email));
		if(empty($user)){
			$model = new Api;
			$model->code = '400';
			$model->error = 'Email does not exists!';
			echo json_encode($model);
			exit;
		}
		if($password != $user->Password){
			$model = new Api;
			$model->code = '403';
			$model->error = 'Email or password error!';
			echo json_encode($model);
			exit;
		}
		$resume = Resume::model()->find('ResumeMainId=:Id',array(':Id'=>$resumeMain->Id));
		if($resume->UserId != $user->Id){
			$model = new Api;
			$model->code = '403';
			$model->error = 'Access deny!The Id of the Resume is not yours!';
			echo json_encode($model);
			exit;
		}
		$RExperience = new RExperience;
		$RExperience->ResumeMainId = $resumeMain->Id;
		$RExperience->StartDate = date('Y-m-d',strtotime($StartDate));
		$RExperience->EndDate = date('Y-m-d',strtotime($EndDate));
		$RExperience->CompanyName = $CompanyName;
		$RExperience->Type = $Type;
		$RExperience->CompanyType = $CompanyType;
		$RExperience->CompanyScope = $CompanyScope;
		$RExperience->PostName = $PostName;
		$RExperience->WorkContent = $WorkContent;
		if($RExperience->save()){
			$model = new Api;
			$model->code = '200';
			$model->error = '';
			echo json_encode($model);
		}
		else{
			$model = new Api;
			$model->code = '400';
			$model->error = $RExperience->getErrors();
			echo json_encode($model);
		}
	}
}
