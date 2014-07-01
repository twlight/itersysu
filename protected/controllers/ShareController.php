<?php

class ShareController extends Controller
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
				'actions'=>array('index','search','detail'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','my'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		$data = Yii::app()->db->createCommand()
							  ->select('count(*) as c, CompanyName')
							  ->from(ShareAudition::model()->tableName())
							  ->group('CompanyName')
							  ->order('c DESC')
							  ->limit(40)
							  ->queryAll();
		$data2 = Yii::app()->db->createCommand()
							   ->select('count(*) as c, PostName')
							   ->from(ShareAudition::model()->tableName())
							   ->group('PostName')
							   ->order('c DESC')
							   ->limit(20)
							   ->queryAll();
		$this->render('index',array('data'=>$data,'data2'=>$data2));
	}

	public function actionSearch($key){
		$keyStr = '%'.$key.'%';
		$share1 = ShareAudition::model()->findAll('CompanyName LIKE :key',array(':key'=>$keyStr));
		$share2 = ShareAudition::model()->findAll('PostName LIKE :key',array(':key'=>$keyStr));
		$share3 = ShareAudition::model()->findAll('Process LIKE :key',array(':key'=>$keyStr));
		$share4 = ShareAudition::model()->findAll('Question LIKE :key',array(':key'=>$keyStr));
		$share = array_merge($share1,$share2,$share3,$share4);
		$data = array();
		$id = 1;
		$found = array();
		foreach($share as $item){
			if(!in_array($item->Id,$found)){
				$tmp = array();
				$tmp['Id'] = $id++;
				$tmp['Sid'] = $item->Id;
				array_push($found,$item->Id);
				$tmp['CompanyName'] = str_replace($key,'<strong>'.$key.'</strong>',$item->CompanyName,$count1);
				$tmp['PostName'] = str_replace($key,'<strong>'.$key.'</strong>',$item->PostName,$count2);
				$ctmp = mb_substr($item->Process,0,86,'utf8');
				if(count($share3) != 0){
					$tmp['Process'] = stristr($item->Process,$key);
					$tmp['Process'] = str_replace($key,'<strong>'.$key.'</strong>',$tmp['Process']);
				}
				else{
					$tmp['Process'] = $item->Process;
				}
				if(count($share4) != 0){
					$tmp['Question'] = stristr($item->Question,$key);
					$tmp['Question'] = str_replace($key,'<strong>'.$key.'</strong>',$tmp['Question']);
				}
				else{
					$tmp['Question'] = $item->Question;
				}
				$tmp['Place'] = $item->Place;
				$tmp['AuditionTime'] = $item->AuditionTime;
				$tmp['CostTime'] = $item->CostTime;
				$tmp['Way'] = $item->Way;
				$tmp['Method'] = $item->Method;
				$tmp['Difficulty'] = $item->Difficulty;
				$tmp['Feel'] = $item->Feel;
				$tmp['PostTime'] = $item->PostTime;
				array_push($data,$tmp);
			}
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
		$this->render('search',array('dataProvider'=>$dataProvider,'key'=>$key));
	}

	public function actionDetail($id){
		$model = ShareAudition::model()->findByPk($id);
		if(empty($model)){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$this->render('detail',array('model'=>$model));
	}

	public function actionCreate(){
		$model=new ShareAuditionForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='shareaudition-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['ShareAuditionForm']))
		{
			$model->attributes=$_POST['ShareAuditionForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->save())
				$this->redirect(array('share/my'));
		}
		$this->render('create',array('model'=>$model));
	}

	public function actionMy(){
		$share = ShareAudition::model()->findAll('UserId=:id',array(':id'=>Yii::app()->user->UserId));
		$data = array();
		$id = 1;
		$found = array();
		foreach($share as $item){
			if(!in_array($item->Id,$found)){
				$tmp = array();
				$tmp['Id'] = $id++;
				$tmp['Sid'] = $item->Id;
				array_push($found,$item->Id);
				$tmp['CompanyName'] = str_replace($key,'<strong>'.$key.'</strong>',$item->CompanyName,$count1);
				$tmp['PostName'] = str_replace($key,'<strong>'.$key.'</strong>',$item->PostName,$count2);
				$ctmp = mb_substr($item->Process,0,86,'utf8');
				if(count($share3) != 0){
					$tmp['Process'] = stristr($item->Process,$key);
					$tmp['Process'] = str_replace($key,'<strong>'.$key.'</strong>',$tmp['Process']);
				}
				else{
					$tmp['Process'] = $item->Process;
				}
				if(count($share4) != 0){
					$tmp['Question'] = stristr($item->Question,$key);
					$tmp['Question'] = str_replace($key,'<strong>'.$key.'</strong>',$tmp['Question']);
				}
				else{
					$tmp['Question'] = $item->Question;
				}
				$tmp['Place'] = $item->Place;
				$tmp['AuditionTime'] = $item->AuditionTime;
				$tmp['CostTime'] = $item->CostTime;
				$tmp['Way'] = $item->Way;
				$tmp['Method'] = $item->Method;
				$tmp['Difficulty'] = $item->Difficulty;
				$tmp['Feel'] = $item->Feel;
				$tmp['PostTime'] = $item->PostTime;
				array_push($data,$tmp);
			}
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
		$this->render('my',array('dataProvider'=>$dataProvider,'key'=>$key));
	}
}
