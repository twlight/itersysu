<?php

class MyController extends Controller
{
	public $layout='column3';

	public function filters(){
		return array(
			'accessControl',
		);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index','changepw','loginlog','info','gravatar'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		$this->render('index');
	}

	public function actionChangepw(){
		$model = new ChangepwForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='changepw-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['ChangepwForm']))
		{
			$model->attributes=$_POST['ChangepwForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->change()){
				$this->render('changepw',array('model'=>$model,'success'=>true));
			}
			else{
				$this->render('changepw',array('model'=>$model,'success'=>false));
			}
		}
		else{
			$this->render('changepw',array('model'=>$model,'success'=>false));
		}
	}

	public function actionLoginlog(){
		$model = SysLog::model()->find('UserId=:Id ORDER by Time DESC',array(':Id'=>Yii::app()->user->UserId));
		$this->render('loginlog',array('model'=>$model));
	}

	public function actionInfo(){
		$model = User::model()->findByPk(Yii::app()->user->UserId);
		$this->render('info',array('model'=>$model));
	}

	public function actionGravatar(){
		$this->render('gravatar');
	}
}
