<?php

class ResumeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'postOnly + getall',
			'postOnly + process',
			'postOnly + post',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('main'),
				'users'=>array('*'),
				'ips'=>array('127.0.0.1'),
			),
			array('allow',
				'actions'=>array('index','mini','view','file','delete','select','addbyfile','add','getall','post','submitted','main','download'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->UserType==0',
			),
			array('allow',
				'actions'=>array('admin','adminview','adminfile','process','download'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isInfoCompe()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = Resume::model()->findByPk($id);
		if(empty($model)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		if($model->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		if($model->Type == 0){
			$ResumeMain = ResumeMain::model()->findByPk($model->ResumeMainId);
			REdu::model()->deleteAll('ResumeMainId=:Id',array(':Id'=>$ResumeMain->Id));
			RProject::model()->deleteAll('ResumeMainId=:Id',array(':Id'=>$ResumeMain->Id));
			RExperience::model()->deleteAll('ResumeMainId=:Id',array(':Id'=>$ResumeMain->Id));
			$ResumeMain->delete();
		}
		else if($model->Type == 1){
			$ResumeMini = ResumeMini::model()->findByPk($model->ResumeMiniId);
			$ResumeMini->delete();
		}
		else if($model->Type == 2){
			$ResumeFile = ResumeFile::model()->findByPk($model->ResumeFileId);
			$ResumeFile->delete();
		}
		$s = Submitted::model()->deleteAll('ResumeId=:Id',array(':Id'=>$model->Id));
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$id = 1;
		$data = array();
		$model = Resume::model()->findAll('UserId=:UserId ORDER BY ModifyTime DESC',array(':UserId'=>Yii::app()->user->UserId));
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['rid'] = $item->Id;
			if($item->Type == 0){
				$ResumeMain = ResumeMain::model()->find('Id=:ResumeMainId',array(':ResumeMainId'=>$item->ResumeMainId));
				$tmp['Name'] = $ResumeMain->Name;
			}
			else if($item->Type == 1){
				$ResumeMini = ResumeMini::model()->find('Id=:ResumeMiniId',array(':ResumeMiniId'=>$item->ResumeMiniId));
				$tmp['Name'] = '微简历'.$ResumeMini->Id;
			}
			else if($item->Type == 2){
				$ResumeFile = ResumeFile::model()->find('Id=:ResumeFileId',array(':ResumeFileId'=>$item->ResumeFileId));
				$tmp['Name'] = $ResumeFile->Name;
			}
			else{
				$tmp['Name'] = '';
			}
			if($item->Type == 0){
				$tmp['Type'] = '普通简历';
			}
			else if($item->Type == 1){
				$tmp['Type'] = '微简历';
			}
			else if($item->Type == 2){
				$tmp['Type'] = '通过上传文件而生成的简历';
			}
			else{
				$tmp['Type'] = '';
			}
			$tmp['Time'] = $item->ModifyTime;
			if($item->Type == 0){
				$precent = 20;
				if(!empty($ResumeMain->Img)){
					$precent += 20;
				}
				$edu = REdu::model()->find('ResumeMainId=:id',array(':id'=>$item->ResumeMainId));
				if(!empty($edu)){
					$precent += 20;
				}
				$project = RProject::model()->find('ResumeMainId=:id',array(':id'=>$item->ResumeMainId));
				if(!empty($project)){
					$precent += 20;
				}
				$experience = RExperience::model()->find('ResumeMainId=:id',array(':id'=>$item->ResumeMainId));
				if(!empty($experience)){
					$precent += 20;
				}
				$tmp['Comp'] = strval($precent).'%';
			}
			else if($item->Type == 1){
				$tmp['Comp'] = '100%';
			}
			else if($item->Type == 2){
				$tmp['Comp'] = '100%';
			}
			else{
				$tmp['Comp'] = '';
			}
			array_push($data,$tmp);
		}
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$filteredData=$filtersForm->filter($data);
		$dataProvider=new CArrayDataProvider($filteredData,array(
			'sort'=>array(
				'attributes'=>array(
					'Name','Type','Time','Comp',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'filtersForm' => $filtersForm,
		));
	}

	public function actionMini(){
		$id = 1;
		$data = array();
		$model = Resume::model()->findAll('UserId=:UserId AND Type=1 ORDER BY ModifyTime DESC',array(':UserId'=>Yii::app()->user->UserId));
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['rid'] = $item->Id;
			$tmp['Time'] = $item->ModifyTime;
			array_push($data,$tmp);
		}
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$filteredData=$filtersForm->filter($data);
		$dataProvider=new CArrayDataProvider($filteredData,array(
			'sort'=>array(
				'attributes'=>array(
					'rid','Time',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$this->render('mini',array(
			'dataProvider'=>$dataProvider,
			'filtersForm' => $filtersForm,
		));
	}

	public function actionView($id){
		$resume = Resume::model()->findByPk($id);
		if(empty($resume)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		if($resume->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		if($resume->Type == 0){
			$this->layout='//layouts/column1';
			$model = ResumeMain::model()->findByPk($resume->ResumeMainId);
			$str = $this->getMainStr($model);
			$this->render('mainview',array('model'=>$model,'resume'=>$resume,'str'=>$str));
		}
		else if($resume->Type == 1){
			$model = ResumeMini::model()->findByPk($resume->ResumeMiniId);
			$this->render('miniview',array('model'=>$model,'resume'=>$resume));
		}
		else if($resume->Type == 2){
			$model = ResumeFile::model()->findByPk($resume->ResumeFileId);
			$this->render('fileview',array('model'=>$model,'resume'=>$resume,'sid'=>null));
		}
	}

	public function actionSelect(){
		$this->render('select');
	}

	public function actionAdd($step = 0,$id = null){
		if(!empty($id)){
			$resume = Resume::model()->findByPk($id);
			if($resume->UserId != Yii::app()->user->UserId){
				throw new CHttpException(403,'Access deny.');
			}
			if(empty($resume->ResumeMainId)){
				throw new CHttpException(403,'Access deny.');
			}
		}
		if($step == 0 || empty($id)){
			$model = new RBaseForm;
			if(!empty($id)){
				$resumemain = ResumeMain::model()->findByPk($resume->ResumeMainId);
				$model->attributes=$resumemain->attributes;
			}

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='rbase-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			if(isset($_POST['RBaseForm']))
			{
				$model->attributes=$_POST['RBaseForm'];
				if($model->validate() && $n = $model->save($id))
					$this->redirect(array('resume/add','step'=>1,'id'=>$n));
			}
			$this->render('add',array('step'=>$step,'model'=>$model,'id'=>$id));
		}
		else if($step == 1){
			$model = new REduForm;
			if(!empty($id)){
				$redu = REdu::model()->findAll('ResumeMainId=:Id',array(':Id'=>$resume->ResumeMainId));
				if(!empty($redu)){
					$model->REdu = $redu;
				}
				else{
					$model->REdu = array(new REdu);
				}
			}

			if(isset($_POST['REduForm']))
			{
				$model->attributes=$_POST['REduForm'];
				if($model->validate2() && $model->save($resume->ResumeMainId))
					$this->redirect(array('resume/add','step'=>2,'id'=>$id));
			}
			$this->render('add',array('step'=>$step,'model'=>$model,'id'=>$id));
		}
		else if($step == 2){
			$model = new RProForm;
			if(!empty($id)){
				$rpro = RProject::model()->findAll('ResumeMainId=:Id',array(':Id'=>$resume->ResumeMainId));
				if(!empty($rpro)){
					$model->RPro = $rpro;
				}
				else{
					$model->RPro = array(new RProject);
				}
			}

			if(isset($_POST['RProForm']))
			{
				$model->attributes=$_POST['RProForm'];
				if($model->validate2() && $model->save($resume->ResumeMainId))
					$this->redirect(array('resume/add','step'=>3,'id'=>$id));
			}
			$this->render('add',array('step'=>$step,'model'=>$model,'id'=>$id));
		}
		else if($step == 3){
			$model = new RExpForm;
			if(!empty($id)){
				$rexp = RExperience::model()->findAll('ResumeMainId=:Id',array(':Id'=>$resume->ResumeMainId));
				if(!empty($rexp)){
					$model->RExp = $rexp;
				}
				else{
					$model->RExp = array(new RExperience);
				}
			}

			if(isset($_POST['RExpForm']))
			{
				$model->attributes=$_POST['RExpForm'];
				if($model->validate2() && $model->save($resume->ResumeMainId))
					$this->redirect(array('resume/add','step'=>4,'id'=>$id));
			}
			$this->render('add',array('step'=>$step,'model'=>$model,'id'=>$id));
		}
		else if($step == 4){
			$model = new RPicForm;
			if(!empty($id)){
				$resumemain = ResumeMain::model()->findByPk($resume->ResumeMainId);
			}

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='rpic-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			if(isset($_POST['RPicForm']))
			{
				ini_set('upload_max_filesize','2M');
				ini_set('MAX_FILE_SIZE','0');
				$model->attributes=$_POST['RPicForm'];
				$model->file = CUploadedFile::getInstance($model,'file');
				if($model->validate() && $model->save($resume->ResumeMainId))
					$this->redirect(array('resume/index'));
			}
			$this->render('add',array('step'=>$step,'model'=>$model,'id'=>$id));
		}
		else{
			throw new CHttpException(403,'Access deny.');
		}
	}

	public function actionAddbyfile($id = null){
		$model = new FileForm;
		$filename = null;
		$new = true;
		if(!empty($id)){
			$new = false;
			$resume = Resume::model()->findByPk($id);
			if(empty($resume)){
				throw new CHttpException(404,'The requested page does not exist.');
			}
			if(empty($resume->ResumeFileId)){
				throw new CHttpException(404,'The requested page does not exist.');
			}
			$file = ResumeFile::model()->findByPk($resume->ResumeFileId);
			$model->filename = $file->Name;
			$model->Username = $file->Username;
			$model->Sex = $file->Sex;
			$model->Edu = $file->Edu;
			$model->Experience = $file->Experience;
			$filename = $file->Filename;
		}

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['FileForm']))
		{
			ini_set('upload_max_filesize','2M');
			ini_set('MAX_FILE_SIZE','0');
			$model->attributes=$_POST['FileForm'];
			$model->file = CUploadedFile::getInstance($model,'file');
			if($model->validate() && $model->save($id))
				$this->redirect(array('resume/index'));
		}

		$this->render('addbyfile',array('model'=>$model,'id'=>$id,'filename'=>$filename,'new'=>$new));
	}

	public function actionFile($id){
		$file = ResumeFile::model()->findByPk($id);
		if(empty($file)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$resume = Resume::model()->find('ResumeFileId=:Id',array(':Id'=>$file->Id));
		if(empty($resume)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		if($resume->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		echo $file->Content;
	}

	public function actionAdminfile($sid){
		$submitted = Submitted::model()->findByPk($sid);
		if(empty($submitted)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$detail = WorkinfoDetail::model()->findByPk($submitted->WorkinfoDetailId);
		$workinfo = Workinfo::model()->findByPk($detail->WorkinfoId);
		$company = Company::model()->findByPk($workinfo->CompanyId);
		if($company->UserId != Yii::app()->user->UserId){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$resume = Resume::model()->findByPk($submitted->ResumeId);
		if($resume->Type == 2){
			$model = ResumeFile::model()->findByPk($resume->ResumeFileId);
			echo $model->Content;
		}
	}

	public function actionGetall(){
		$model = Resume::model()->findAll('UserId=:UserId AND Type!=1 ORDER BY ModifyTime DESC',array(':UserId'=>Yii::app()->user->UserId));
		$arr = array();
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $item->Id;
			if($item->Type == 0){
				$main = ResumeMain::model()->findByPk($item->ResumeMainId);
				$tmp['name'] = $main->Name;
				$tmp['type'] = "普通简历";
			}
			else if($item->Type == 2){
				$file = ResumeFile::model()->findByPk($item->ResumeFileId);
				$tmp['name'] = $file->Name;
				$tmp['type'] = "文件简历";
			}
			array_push($arr,$tmp);
		}
		echo json_encode($arr);
	}

	public function actionPost($work,$resume){
		$r = Resume::model()->findByPk($resume);
		if(empty($r)){
			throw new CHttpException(403,'Access deny.');
		}
		if($r->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		$isArr = strpos($work,',');
		if($isArr == false){
			$id = intval($work);
			$workinfodetail = WorkinfoDetail::model()->findByPk($id);
			if($workinfodetail === null){
				throw new CHttpException(404,'The requested page does not exist1.');
			}
			$sub = Submitted::model()->find('UserId=:UserId AND WorkinfoDetailId=:WorkinfoDetailId',array(':UserId'=>Yii::app()->user->UserId,':WorkinfoDetailId'=>$workinfodetail->Id));
			if(empty($sub)){
				$model = new Submitted;
				$model->UserId = Yii::app()->user->UserId;
				$model->WorkinfoDetailId = $workinfodetail->Id;
				$model->ResumeId = $r->Id;
				$model->Time = date('Y-m-d H:i:s');
				$model->save();
			}
		}
		else{
			$arr = split(',',$work);
			foreach($arr as $item){
				$id = intval($item);
				$workinfodetail = WorkinfoDetail::model()->findByPk($id);
				if($workinfodetail === null){
					throw new CHttpException(404,'The requested page does not exist1.');
				}
				$sub = Submitted::model()->find('UserId=:UserId AND WorkinfoDetailId=:WorkinfoDetailId',array(':UserId'=>Yii::app()->user->UserId,':WorkinfoDetailId'=>$workinfodetail->Id));
				if(empty($sub)){
					$model = new Submitted;
					$model->UserId = Yii::app()->user->UserId;
					$model->WorkinfoDetailId = $workinfodetail->Id;
					$model->ResumeId = $r->Id;
					$model->Time = date('Y-m-d H:i:s');
					$model->save();
				}
			}
		}
	}

	public function actionSubmitted(){
		$model = Submitted::model()->findAll('UserId=:Id ORDER BY Time DESC',array(':Id'=>Yii::app()->user->UserId));
		$data = array();
		$id = 1;
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['WorkinfoDetailId'] = $item->WorkinfoDetailId;
			$detail = WorkinfoDetail::model()->findByPk($item->WorkinfoDetailId);
			$tmp['WorkName'] = $detail->WorkName;
			$workinfo = Workinfo::model()->findByPk($detail->WorkinfoId);
			$tmp['WorkinfoId'] = $workinfo->Id;
			$company = Company::model()->findByPk($workinfo->CompanyId);
			$tmp['CompanyName'] = $company->CompanyName;
			$tmp['ResumeId'] = $item->ResumeId;
			$resume = Resume::model()->findByPk($item->ResumeId);
			if($resume->Type == 0){
				$main = ResumeMain::model()->findByPk($resume->ResumeMainId);
				$tmp['ResumeName'] = $main->Name;
			}
			else if($resume->Type == 1){
				$tmp['ResumeName'] = '微简历'.$resume->Id;
			}
			else if($resume->Type == 2){
				$file = ResumeFile::model()->findByPk($resume->ResumeFileId);
				$tmp['ResumeName'] = $file->Name;
			}
			$tmp['Time'] = $item->Time;
			array_push($data,$tmp);
		}
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$filteredData=$filtersForm->filter($data);
		$dataProvider=new CArrayDataProvider($filteredData,array(
			'sort'=>array(
				'attributes'=>array(
					'WorkName','CompanyName','ResumeName','Time',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$this->render('submitted',array('dataProvider'=>$dataProvider));
	}

	public function actionAdmin($p=null){
		$this->layout = 'column3';
		$submit = Yii::app()->db->createCommand()
								->select('*')
								->from(Submitted::model()->tableName().' s')
								->join(WorkinfoDetail::model()->tableName().' d', 's.WorkinfoDetailId=d.Id')
								->join(Workinfo::model()->tableName().' w', 'd.WorkinfoId=w.Id')
								->join(Company::model()->tableName().' c', 'w.CompanyId=c.Id')
								->where('c.UserId=:id', array(':id'=>Yii::app()->user->UserId,))
								->queryAll();
		$data = array();
		$i = 1;
		foreach($submit as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['sid'] = $item['Id'];
			$tmp['wid'] = $item['WorkinfoDetailId'];
			$tmp['WorkName'] = $item['WorkName'];
			$r = Resume::model()->findByPk($item['ResumeId']);
			$tmp['rid'] = $item['ResumeId'];
			if($r->Type == 0){
				$main = ResumeMain::model()->findByPk($r->ResumeMainId);
				$tmp['ResumeName'] = $main->Name;
				$tmp['ResumeType'] = '普通简历';
				$tmp['Username'] = $main->Username;
				$tmp['Sex'] = $main->Sex;
				$tmp['Edu'] = $main->Edu;
				$tmp['Experience'] = $main->Experience;
			}
			else if($r->Type == 1){
				$mini = ResumeMini::model()->findByPk($r->ResumeMiniId);
				$tmp['ResumeName'] = '微简历'.$item->ResumeId;
				$tmp['ResumeType'] = '微简历';
				$tmp['Username'] = $mini->Username;
				$tmp['Sex'] = $mini->Sex;
				$tmp['Edu'] = $mini->Edu;
				$tmp['Experience'] = '';
			}
			else if($r->Type == 2){
				$file = ResumeFile::model()->findByPk($r->ResumeFileId);
				$tmp['ResumeName'] = $file->Name;
				$tmp['ResumeType'] = '文件简历';
				$tmp['Username'] = $file->Username;
				$tmp['Sex'] = $file->Sex;
				$tmp['Edu'] = $file->Edu;
				$tmp['Experience'] = $file->Experience;
			}
			$tmp['Time'] = $item['Time'];
			$tmp['Processed'] = $item['Processed'];
			array_push($data,$tmp);
		}
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$filteredData=$filtersForm->filter($data);
		$dataProvider=new CArrayDataProvider($filteredData,array(
			'sort'=>array(
				'attributes'=>array(
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$this->render('admin',array('dataProvider'=>$dataProvider));
	}

	public function actionProcess($str, $t=1){
		if($t != 1){
			$t = 0;
		}
		$isArr = strpos($str,',');
		if($isArr === false){
			$id = intval($str);
			$submit = Submitted::model()->findByPk($id);
			if(empty($submit)){
				throw new CHttpException(404,'The requested page does not exist.');
			}
			$detail = WorkinfoDetail::model()->findByPk($submit->WorkinfoDetailId);
			$workinfo = Workinfo::model()->findByPk($detail->WorkinfoId);
			$company = Company::model()->findByPk($workinfo->CompanyId);
			if($company->UserId != Yii::app()->user->UserId){
				throw new CHttpException(403,'Access Deny.');
			}
			$submit->Processed = $t;
			$submit->save();
		}
		else{
			$arr = split(',',$str);
			foreach($arr as $item){
				$id = intval($item);
				$submit = Submitted::model()->findByPk($id);
				if(empty($submit)){
					throw new CHttpException(404,'The requested page does not exist.');
				}
				$detail = WorkinfoDetail::model()->findByPk($submit->WorkinfoDetailId);
				$workinfo = Workinfo::model()->findByPk($detail->WorkinfoId);
				$company = Company::model()->findByPk($workinfo->CompanyId);
				if($company->UserId != Yii::app()->user->UserId){
					throw new CHttpException(403,'Access Deny.');
				}
				$submit->Processed = $t;
				$submit->save();
			}
		}
	}

	public function actionAdminview($sid){
		$submitted = Submitted::model()->findByPk($sid);
		if(empty($submitted)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$detail = WorkinfoDetail::model()->findByPk($submitted->WorkinfoDetailId);
		$workinfo = Workinfo::model()->findByPk($detail->WorkinfoId);
		$company = Company::model()->findByPk($workinfo->CompanyId);
		if($company->UserId != Yii::app()->user->UserId){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$resume = Resume::model()->findByPk($submitted->ResumeId);
		if(empty($resume)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		if($resume->Type == 0){
			$this->layout='//layouts/column1';
			$model = ResumeMain::model()->findByPk($resume->ResumeMainId);
			$str = $this->getMainStr($model);
			$this->render('mainview',array('model'=>$model,'resume'=>$resume,'str'=>$str));
		}
		else if($resume->Type == 1){
			$model = ResumeMini::model()->findByPk($resume->ResumeMiniId);
			$this->render('miniview',array('model'=>$model,'resume'=>$resume));
		}
		else if($resume->Type == 2){
			$model = ResumeFile::model()->findByPk($resume->ResumeFileId);
			$this->render('fileview',array('model'=>$model,'resume'=>$resume,'sid'=>$submitted->Id));
		}
	}

	public function actionMain(){
		$id = $_REQUEST['id'];
		$id = intval($id);
		$resume = Resume::model()->findByPk($id);
		if($_SERVER["REMOTE_ADDR"] != '127.0.0.1'){
			if(empty($resume)){
				throw new CHttpException(404,'The requested page does not exist1.');
			}
			if(empty($resume->ResumeMainId)){
				throw new CHttpException(404,'The requested page does not exist2.');
			}
			if(Yii::app()->user->UserType == 0){
				if($resume->UserId != Yii::app()->user->UserId){
					throw new CHttpException(403,'Access deny.');
				}
			}
			else if(Yii::app()->user->UserType == 1){
				$submit = Submitted::model()->find('UserId=:id AND ResumeId=:rid',array(':id'=>Yii::app()->user->UserId,':rid'=>$resume->Id));
				if(empty($submit)){
					throw new CHttpException(403,'Access deny.');
				}
			}
		}
		$main = ResumeMain::model()->findByPk($resume->ResumeMainId);
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo CHtml::openTag('html',array('xmlns'=>'http://www.w3.org/1999/xhtml','xml:lang'=>'en','lang'=>'en'));
		echo CHtml::openTag('head');
		echo CHtml::tag('meta',array('http-equiv'=>'Content-Type','content'=>'text/html; charset=utf-8'));
		echo CHtml::tag('meta',array('name'=>'language','content'=>'zh-cn'));
		echo CHtml::tag('title',array(),'查看简历');
		echo CHtml::closeTag('head');
		echo CHtml::openTag('body');
		echo $this->getMainStr($main);
		echo CHtml::closeTag('body');
		echo CHtml::closeTag('html');
	}

	private function getMainStr($main){
		$str = CHtml::openTag('div',array('style'=>'margin-left:auto;margin-right:auto;width:900px;margin-bottom:40px;'));
		$str .= CHtml::tag('h1',array('style'=>'margin:0px;font-size:16px;'),'ITer学子成长平台');
		$str .= CHtml::tag('h2',array('style'=>'margin-bottom:10px;font-size:20px;margin-top:40px;'),'个人信息');
		$str .= CHtml::openTag('table');
		$str .= CHtml::openTag('tbody');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'姓名：');
		$str .= CHtml::tag('td',array('style'=>'width:300px;'),$main->Username);
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'性别：');
		$str .= CHtml::tag('td',array('style'=>'width:220px;'),$main->Sex == 1 ? '男' : '女');
		$str .= CHtml::openTag('td',array('rowspan'=>'5','style'=>'text-align:right;'));
		if(empty($main->Img) || !file_exists(dirname(dirname(dirname(__FILE__))).'/images/'.$main->Img)){
			$img = base64_encode(file_get_contents(Yii::app()->request->baseUrl.'./images/no_photo.gif'));
		}
		else{
			$img = base64_encode(file_get_contents(Yii::app()->request->baseUrl.'./images/'.$main->Img));
		}
		$str .= CHtml::tag('img',array('src'=>'data:image/png;base64,'.$img,'style'=>'width:99px;height:122px;border:1px solid black;'),'');
		$str .= CHtml::closeTag('td');
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'出生日期：');
		$str .= CHtml::tag('td',array(),$main->Birth);
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'婚姻状况：');
		$str .= CHtml::tag('td',array(),Info::getMarrage($main->Marrage));
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'户口所在地：');
		$str .= CHtml::tag('td',array(),$main->Hukou);
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'住址：');
		$str .= CHtml::tag('td',array(),$main->Address);
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'教育程度：');
		$str .= CHtml::tag('td',array(),Info::getEdu_User($main->Edu));
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'工作经验：');
		$str .= CHtml::tag('td',array(),Info::getExperience_User($main->Experience));
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'联系电话：');
		$str .= CHtml::tag('td',array(),$main->Tel);
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'Email：');
		$str .= CHtml::tag('td',array(),$main->Email);
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'QQ：');
		$str .= CHtml::tag('td',array(),$main->QQ);
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'个人博客：');
		$str .= CHtml::tag('td',array(),$main->Url);
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'兴趣爱好：');
		$str .= CHtml::tag('td',array('colspan'=>'4'),$main->Hobby);
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::openTag('tr');
		$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'获奖经历：');
		$str .= CHtml::tag('td',array('colspan'=>'4'),$main->Awarded);
		$str .= CHtml::closeTag('tr');
		$str .= CHtml::closeTag('tbody');
		$str .= CHtml::closeTag('table');

		$str .= CHtml::tag('hr',array(),'');
		$str .= CHtml::tag('h2',array('style'=>'margin-bottom:10px;font-size:20px;margin-top:40px;'),'教育信息');
		$edu = REdu::model()->findAll('ResumeMainId=:id',array(':id'=>$main->Id));
		foreach($edu as $item){
			$str .= CHtml::openTag('div',array());
			$str .= CHtml::openTag('table');
			$str .= CHtml::openTag('thead');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('th',array(),'时间');
			$str .= CHtml::tag('th',array(),'学校');
			$str .= CHtml::tag('th',array(),'专业');
			$str .= CHtml::tag('th',array(),'学历');
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::closeTag('thead');
			$str .= CHtml::openTag('tbody');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:240px;text-align:center;'),$item->StartDate.' - '.$item->EndDate);
			$str .= CHtml::tag('td',array('style'=>'width:240px;text-align:center;'),$item->SchoolName);
			$str .= CHtml::tag('td',array('style'=>'width:240px;text-align:center;'),$item->SpecialtyName);
			$str .= CHtml::tag('td',array('style'=>'width:240px;text-align:center;'),Info::getEdu_User($item->Edu));
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::closeTag('tbody');
			$str .= CHtml::closeTag('table');
			$str .= CHtml::closeTag('div');
		}

		$str .= CHtml::tag('hr',array(),'');
		$str .= CHtml::tag('h2',array('style'=>'margin-bottom:10px;font-size:20px;margin-top:40px;'),'项目信息');
		$project = RProject::model()->findAll('ResumeMainId=:id',array(':id'=>$main->Id));
		foreach($project as $item){
			if($item->Id != $project[count($project)-1]->Id){
				$str .= CHtml::openTag('div',array('style'=>'margin-bottom:10px;border-bottom:1px dashed gray;padding-bottom:10px;'));
			}
			else{
				$str .= CHtml::openTag('div',array());
			}
			$str .= CHtml::openTag('table');
			$str .= CHtml::openTag('tbody');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'项目名称：');
			$str .= CHtml::tag('td',array('style'=>''),$item->Name);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'职务/角色：');
			$str .= CHtml::tag('td',array('style'=>''),$item->Role);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'项目间接：');
			$str .= CHtml::tag('td',array('style'=>''),$item->Introduction);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'项目职责：');
			$str .= CHtml::tag('td',array('style'=>''),$item->Content);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::closeTag('tbody');
			$str .= CHtml::closeTag('table');
			$str .= CHtml::closeTag('div');
		}

		$str .= CHtml::tag('hr',array(),'');
		$str .= CHtml::tag('h2',array('style'=>'margin-bottom:10px;font-size:20px;margin-top:40px;'),'工作经验');
		$experience = RExperience::model()->findAll('ResumeMainId=:id',array(':id'=>$main->Id));
		foreach($experience as $item){
			if($item->Id != $experience[count($experience)-1]->Id){
				$str .= CHtml::openTag('div',array('style'=>'margin-bottom:10px;border-bottom:1px dashed gray;padding-bottom:10px;'));
			}
			else{
				$str .= CHtml::openTag('div',array());
			}
			$str .= CHtml::openTag('table');
			$str .= CHtml::openTag('tbody');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'时间：');
			$str .= CHtml::tag('td',array('style'=>''),$item->StartDate.' - '.$item->EndDate);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'工作单位：');
			$str .= CHtml::tag('td',array('style'=>''),$item->CompanyName);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'工作性质：');
			$str .= CHtml::tag('td',array('style'=>''),Info::getWorkType($item->Type));
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'公司性质：');
			$str .= CHtml::tag('td',array('style'=>''),Info::getCompanyType($item->CompanyType));
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'公司规模：');
			$str .= CHtml::tag('td',array('style'=>''),Info::getScope($item->CompanyScope));
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'职位：');
			$str .= CHtml::tag('td',array('style'=>''),$item->PostName);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::openTag('tr');
			$str .= CHtml::tag('td',array('style'=>'width:100px;text-align:right;'),'公司职责：');
			$str .= CHtml::tag('td',array('style'=>''),$item->WorkContent);
			$str .= CHtml::closeTag('tr');
			$str .= CHtml::closeTag('tbody');
			$str .= CHtml::closeTag('table');
			$str .= CHtml::closeTag('div');
		}
		$str .= CHtml::closeTag('div');
		return $str;
	}

	public function actionDownload($id){
		$resume = Resume::model()->findByPk($id);
		if(empty($resume)){
			throw new CHttpException(404,'The requested page does not exist1.');
		}
		if(empty($resume->ResumeMainId) && empty($resume->ResumeFileId)){
			throw new CHttpException(404,'The requested page does not exist2.');
		}
		if(Yii::app()->user->UserType == 0){
			if($resume->UserId != Yii::app()->user->UserId){
				throw new CHttpException(403,'Access deny.');
			}
		}
		else if(Yii::app()->user->UserType == 1){
			$submit = Yii::app()->db->createCommand()
									->select('*')
									->from(Submitted::model()->tableName().' s')
									->join(WorkinfoDetail::model()->tableName().' d', 's.WorkinfoDetailId=d.Id')
									->join(Workinfo::model()->tableName().' w', 'd.WorkinfoId=w.Id')
									->join(Company::model()->tableName().' c', 'w.CompanyId=c.Id')
									->where('c.UserId=:id AND s.ResumeId=:rid', array(':id'=>Yii::app()->user->UserId,':rid'=>$resume->Id))
									->queryRow();
			if(empty($submit)){
				throw new CHttpException(403,'Access deny.1');
			}
		}
		if(!empty($resume->ResumeMainId)){
			$main = ResumeMain::model()->findByPk($resume->ResumeMainId);
			$dir = dirname(dirname(__FILE__));
			$fn = time().rand(0,9999);
			exec('curl http://127.0.0.1/index.php?r=resume/main -d id=37 -o '.$dir.'/tmp/'.$fn.'.html');
			exec($dir.'/wkhtmltopdf-amd64 '.$dir.'/tmp/'.$fn.'.html '.$dir.'/tmp/'.$fn.'.pdf');
			$filename = $dir.'/tmp/'.$fn.'.pdf';
			header("Cache-Control: public"); 
			header("Content-Description: File Transfer"); 
			header('Content-disposition: attachment; filename=ITer学子成长平台_'.$main->Username.'的简历'); 
			header("Content-Type: application/pdf");
			header("Content-Transfer-Encoding: binary"); 
			header('Content-Length: '. filesize($filename)); 
			readfile($filename);
			exit;
		}
		else if(!empty($resume->ResumeFileId)){
			$file = ResumeFile::model()->findByPk($resume->ResumeFileId);
			$dir = dirname(dirname(__FILE__)).'/resumes/';
			$filename = $dir.$file->RealFilename;
			if(Yii::app()->user->UserType == 0){
				$dfn = $file->Filename;
			}
			else{
				$dfn = 'ITer学子成长平台_'.$file->Username.'的简历.'.pathinfo($filename, PATHINFO_EXTENSION);
			}
			header("Cache-Control: public"); 
			header("Content-Description: File Transfer"); 
			header('Content-disposition: attachment; filename='.$dfn);
			header("Content-Type: application/vnd.openxmlformats");
			header("Content-Transfer-Encoding: binary"); 
			header('Content-Length: '. filesize($filename)); 
			readfile($filename);
		}
	}
}
