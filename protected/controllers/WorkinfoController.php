<?php

class WorkinfoController extends Controller
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
				'actions'=>array('index','detail'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('admin','create','delete'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isInfoCompe()',
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex($id){
		$workinfo = Workinfo::model()->findByPk($id);
		if(empty($workinfo)){
			throw new CHttpException(404,'未找到页面！');
		}
		$this->render('index',array('workinfo'=>$workinfo));
	}

	public function actionDetail($id){
		$workinfoDetail = WorkinfoDetail::model()->findByPk($id);
		if(empty($workinfoDetail)){
			throw new CHttpException(404,'未找到页面！');
		}
		$this->render('detail',array('workinfoDetail'=>$workinfoDetail));
	}

	public function actionAdmin(){
		$this->layout = 'column3';
		$company = Company::model()->find('UserId=:Id',array(':Id'=>Yii::app()->user->UserId));
		$model=new Workinfo('search');
		$model->unsetAttributes();
		if(isset($_GET['Workinfo'])){
			$model->attributes=$_GET['Workinfo'];
    	}
		$userid = Yii::app()->user->UserId;
		$model->getDbCriteria()->mergeWith(
			array(
				'condition'=>"CompanyId=$company->Id",
		));
		$this->render('admin',array('model'=>$model));
	}

	public function actionCreate($id=null){
		$model = new WorkinfoForm;
		if(!empty($id)){
			$workinfo = Workinfo::model()->findByPk($id);
			if(empty($workinfo)){
				throw new CHttpException(403,'Access Deny！');
			}
			$company = Company::model()->findByPk($workinfo->CompanyId);
			if($company->UserId != Yii::app()->user->UserId){
				throw new CHttpException(403,'Access Deny！');
			}
			$model->attributes = $workinfo->attributes;
		}
		$position = Position::model()->findAll('UserId=:Id',array(':Id'=>Yii::app()->user->UserId));
		$model->position = $position;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='workinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['WorkinfoForm']))
		{
			$model->attributes=$_POST['WorkinfoForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->validate2() && $model->save())
				$this->redirect(array('admin'));
		}
		$this->render('create',array('model'=>$model,'position'=>$position));
	}

	public function actionDelete($id){
		$workinfo = Workinfo::model()->findByPk($id);
		if(empty($workinfo)){
			throw new CHttpException(404,'未找到页面！');
		}
		$company = Company::model()->findByPk($workinfo->CompanyId);
		if($company->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access Deny！');
		}
		$detail = WorkinfoDetail::model()->findAll('WorkinfoId=:Id',array(':Id'=>$workinfo->Id));
		foreach($detail as $item){
			$submitted = Submitted::model()->deleteAll('WorkinfoDetailId=:Id',array(':Id'=>$item->Id));
			$item->delete();
		}
		$workinfo->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}
}
