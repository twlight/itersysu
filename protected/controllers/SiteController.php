<?php

class SiteController extends Controller
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
				'actions'=>array('index','error'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('login','userReg','comReg'),
				'users'=>array('*'),
				'expression'=>'Yii::app()->user->isGuest'
			),
			array('allow',
				'actions'=>array('logout'),
				'users'=>array('@'),
				'expression'=>'!Yii::app()->user->isGuest'
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionIndex(){
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('index',array('model'=>$model));
	}

	public function actionUserReg(){
		$model=new UserRegForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='userReg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['UserRegForm']))
		{
			$model->attributes=$_POST['UserRegForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->register())
				$this->redirect(array('login'));
		}
		$this->render('userReg',array('model'=>$model));
	}

	public function actionComReg(){
		$model=new ComRegForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='comReg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ComRegForm']))
		{
			$model->attributes=$_POST['ComRegForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->register())
				$this->redirect(array('login'));
		}
		$this->render('comReg',array('model'=>$model));
	}
}
