<?php

class AnnounceController extends Controller
{
	public $layout='column1';

	public function filters(){
		return array(
			'accessControl',
			'postOnly + addfav', // we only allow deletion via POST request
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('addfav','fav','delete'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->UserType==0',
			),
			array('allow',
				'actions'=>array('create','admin'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isInfoCompe()',
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		$model = Announce::model()->findAll('Date>=:Date',array(':Date'=>date('Y-m-d')));
		$data = array();
		$id = 1;
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['fid'] = $item->Id;
			$company = Company::model()->find('UserId=:Id',array(':Id'=>$item->UserId));
			$tmp['CompanyName'] = $company->CompanyName;
			$bt = BusinessType::model()->findByPk($company->BusinessTypeId);
			if($bt->ParentId != 0){
				$bt2 = BusinessType::model()->findByPk($bt->ParentId);
				$tmp['BusinessType'] = $bt->Name;
				$tmp['SubBusinessType'] = $bt2->Name;
			}
			else{
				$tmp['BusinessType'] = $bt->Name;
				$tmp['SubBusinessType'] = null;
			}
			$tmp['City'] = $item->City;
			$tmp['School'] = $item->School;
			$tmp['Date'] = $item->Date;
			$tmp['StartTime'] = $item->StartTime;
			$tmp['EndTime'] = $item->EndTime;
			$tmp['Address'] = $item->Address;
			$tmp['Remark'] = $item->Remark;
			array_push($data,$tmp);
		}

		$dataProvider=new CArrayDataProvider($data,array(
			 'sort'=>array(
				'attributes'=>array(
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		$this->render('index',array('dataProvider'=>$dataProvider));
	}

	public function actionAddfav($id){
		$announce = Announce::model()->findByPk($id);
		if(empty($announce)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$AFav = new AFav;
		$AFav->UserId = Yii::app()->user->UserId;
		$AFav->AnnounceId = $announce->Id;
		$AFav->save();
	}

	public function actionFav(){
		$this->layout='column3';
		$model = AFav::model()->findAll('UserId=:Id',array(':Id'=>Yii::app()->user->UserId));
		$data = array();
		$id = 1;
		foreach($model as $item){
			$tmp = array();
			$a = Announce::model()->findByPk($item->AnnounceId);
			$tmp['id'] = $id++;
			$tmp['aid'] = $item->AnnounceId;
			$tmp['Date'] = $a->Date;
			$tmp['Time'] = $a->StartTime.'-'.$a->EndTime;
			$company = Company::model()->find('UserId=:Id',array(':Id'=>$a->UserId));
			$tmp['CompanyName'] = $company->CompanyName;
			$tmp['School'] = $a->School;
			$tmp['City'] = $a->City;
			$tmp['Address'] = $a->Address;
			array_push($data,$tmp);
		}
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$filteredData=$filtersForm->filter($data);
		$dataProvider=new CArrayDataProvider($filteredData,array(
			'sort'=>array(
				'attributes'=>array(
					'Date','Time','CompanyName','School','City','Address',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		$this->render('fav',array('dataProvider'=>$dataProvider,'filtersForm'=>$filtersForm));
	}

	public function actionDelete($id){
		$a = AFav::model()->findByPk($id);
		if(empty($a)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		if($a->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		$a->delete();
	}

	public function actionCreate(){
		$this->layout='column3';
		$model = new AnnounceForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='acreate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['AnnounceForm']))
		{
			$model->attributes=$_POST['AnnounceForm'];
			if($model->validate() && $model->save())
				$this->redirect(array('announce/admin'));
		}
		$this->render('create',array('model'=>$model));
	}

	public function actionAdmin(){
		$this->layout='column3';
		$model = Announce::model()->findAll('UserId=:Id',array(':Id'=>Yii::app()->user->UserId));
		$data = array();
		$id = 1;
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['aid'] = $item->Id;
			$tmp['Date'] = $item->Date;
			$tmp['Time'] = $item->StartTime.'-'.$item->EndTime;
			$company = Company::model()->find('UserId=:Id',array(':Id'=>$item->UserId));
			$tmp['CompanyName'] = $company->CompanyName;
			$tmp['School'] = $item->School;
			$tmp['City'] = $item->City;
			$tmp['Address'] = $item->Address;
			array_push($data,$tmp);
		}
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$filteredData=$filtersForm->filter($data);
		$dataProvider=new CArrayDataProvider($filteredData,array(
			'sort'=>array(
				'attributes'=>array(
					'Date','Time','CompanyName','School','City','Address',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		$this->render('admin',array('dataProvider'=>$dataProvider,'filtersForm'=>$filtersForm));
	}
}
