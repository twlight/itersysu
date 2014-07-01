<?php

class PositionController extends Controller
{
	public $layout='column3';

	public function filters(){
		return array(
			'accessControl',
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index','create','view','delete'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isInfoCompe()',
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		$model=new Position('search');
		$model->unsetAttributes();
		if(isset($_GET['Position'])){
			$model->attributes=$_GET['Positon'];
    	}
		$userid = Yii::app()->user->UserId;
		$model->getDbCriteria()->mergeWith(
			array(
				'condition'=>"UserId=$userid",
		));
		$this->render('index',array('model'=>$model));
	}

	public function actionCreate($id=null){
		$model = new PositionForm;
		if(!empty($id)){
			$p = Position::model()->findByPk($id);
			if(empty($p)){
				throw new CHttpException(403,'Access deny.');
			}
			else if($p->UserId != Yii::app()->user->UserId){
				throw new CHttpException(403,'Access deny.');
			}
			$model->attributes = $p->attributes;
		}

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='position-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['PositionForm']))
		{
			$model->attributes=$_POST['PositionForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->save($id))
				$this->redirect(array('position/index'));
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionView($id){
		$model = Position::model()->findByPk($id);
		if(empty($model)){
			throw new CHttpException(403,'Access deny.');
		}
		if($model->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		$this->render('view',array('model'=>$model));
	}

	public function actionDelete($id){
		$model = Position::model()->findByPk($id);
		if(empty($model)){
			throw new CHttpException(403,'Access deny.');
		}
		if($model->UserId != Yii::app()->user->UserId){
			throw new CHttpException(403,'Access deny.');
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}
}
