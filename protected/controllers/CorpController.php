<?php

class CorpController extends Controller
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
				'actions'=>array('edit','view'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->UserType==1',
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionEdit(){
		$Company = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
		$model = new CorpForm;
		$model->attributes = $Company->attributes;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='corpEdit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['CorpForm']))
		{
			$model->attributes=$_POST['CorpForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->save())
				$this->redirect(array('corp/view'));
		}

		$this->render('edit',array('model'=>$model));
	}

	public function actionView(){
		$model = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
		$this->render('view',array('model'=>$model));
	}
}
