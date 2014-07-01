<?php

class FavouriteController extends Controller
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
			'postOnly + add',
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
				'actions'=>array('index','delete','add'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->UserType==0',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAdd($str){
		$isArr = strpos($str,',');
		if($isArr === false){
			$id = intval($str);
			$workinfodetail = WorkinfoDetail::model()->findByPk($id);
			if($workinfodetail === null){
				throw new CHttpException(404,'The requested page does not exist1.');
			}
			$fav = Favourite::model()->find('UserId=:UserId AND WorkinfoDetailId=:WorkinfoDetailId',array(':UserId'=>Yii::app()->user->UserId,':WorkinfoDetailId'=>$workinfodetail->Id));
			if(empty($fav)){
				$model = new Favourite;
				$model->UserId = Yii::app()->user->UserId;
				$model->WorkinfoDetailId = $workinfodetail->Id;
				$model->Time = date('Y-m-d H:i:s');
				$model->save();
			}
		}
		else{
			$arr = split(',',$str);
			foreach($arr as $item){
				$id = intval($item);
				$workinfodetail = WorkinfoDetail::model()->findByPk($id);
				if($workinfodetail === null){
					throw new CHttpException(404,'The requested page does not exist1.');
				}
				$fav = Favourite::model()->find('UserId=:UserId AND WorkinfoDetailId=:WorkinfoDetailId',array(':UserId'=>Yii::app()->user->UserId,':WorkinfoDetailId'=>$workinfodetail->Id));
				if(empty($fav)){
					$model = new Favourite;
					$model->UserId = Yii::app()->user->UserId;
					$model->WorkinfoDetailId = $workinfodetail->Id;
					$model->Time = date('Y-m-d H:i:s');
					$model->save();
				}
			}
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($str)
	{
		$isArr = strpos($str,',');
		if($isArr === false){
			$id = intval($str);
			$model=Favourite::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist1.');
			$model->delete();
		}
		else{
			$arr = split(',',$str);
			foreach($arr as $item){
				$id = intval($item);
				$model=Favourite::model()->findByPk($id);
				if($model===null)
					throw new CHttpException(404,'The requested page does not exist.');
				$model->delete();
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function actionIndex()
	{
		$model = Favourite::model()->findAll('UserId=:Id',array(':Id'=>Yii::app()->user->UserId));
		$data = array();
		$id = 1;
		foreach($model as $item){
			$tmp = array();
			$tmp['id'] = $id++;
			$tmp['fid'] = $item->Id;
			$tmp['Time'] = $item->Time;
			$tmp['WorkinfoDetailId'] = $item->WorkinfoDetailId;
			$workinfodetail = WorkinfoDetail::model()->findByPk($item->WorkinfoDetailId);
			$tmp['WorkinfoId'] = $workinfodetail->WorkinfoId;
			$tmp['WorkName'] = $workinfodetail->WorkName;
			$workinfo = Workinfo::model()->findByPk($workinfodetail->WorkinfoId);
			$company = Company::model()->findByPk($workinfo->CompanyId);
			$tmp['CompanyName'] = $company->CompanyName;
			$tmp['Pay'] = $workinfodetail->Pay;
			$tmp['WorkPlace'] = $workinfodetail->WorkPlace;
			$tmp['ZhaoPin_Place'] = $workinfodetail->ZhaoPin_Place;
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

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param Favourite $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='favourite-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
