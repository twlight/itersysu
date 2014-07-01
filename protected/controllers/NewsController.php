<?php

class NewsController extends Controller
{
	public $layout='column1';

	public function filters(){
		return array(
			'accessControl',
			'postOnly + like',
		);
	}

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index','detail','more','search','like'),
				'users'=>array('*'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		$latest = News::model()->find('1 ORDER BY PostTime DESC');
		$recommend = News::model()->findAll('1 ORDER BY Clicked DESC LIMIT 5');
		$this->render('index',array('latest'=>$latest,'recommend'=>$recommend));
	}

	public function actionDetail($id){
		$news = News::model()->findByPk($id);
		if(empty($news)){
			throw new CHttpException(404,'未找到页面！');
		}
		$news->Clicked++;
		$news->save();
		$this->render('detail',array('news'=>$news));
	}

	public function actionMore($id){
		$sort = NSort::model()->findByPk($id);
		if(empty($sort)){
			throw new CHttpException(404,'未找到页面！');
		}
		$news = News::model()->findAll('SortId=:Id ORDER BY PostTime DESC',array(':Id'=>$sort->Id));
		$data = array();
		$id = 1;
		foreach($news as $item){
			$tmp = array();
			$tmp['Id'] = $id++;
			$tmp['Nid'] = $item->Id;
			$tmp['Title'] = $item->Title;
			$tmp['Content'] = $item->Content;
			$tmp['Clicked'] = $item->Clicked;
			$tmp['Like'] = $item->Like;
			$tmp['PostTime'] = $item->PostTime;
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
		$this->render('more',array('sort'=>$sort,'dataProvider'=>$dataProvider));
	}

	public function actionSearch($key){
		$keyStr = '%'.$key.'%';
		$news1 = News::model()->findAll('Title LIKE :key',array(':key'=>$keyStr));
		$news2 = News::model()->findAll('Content LIKE :key',array(':key'=>$keyStr));
		$news = array_merge($news1,$news2);
		//$news = News::model()->findAll('Title LIKE :key OR Content LIKE :key',array(':key'=>$keyStr));
		$data = array();
		$id = 1;
		$found = array();
		foreach($news as $item){
			if(!in_array($item->Id,$found)){
				$tmp = array();
				$tmp['Id'] = $id++;
				$tmp['Nid'] = $item->Id;
				array_push($found,$item->Id);
				$tmp['Title'] = str_replace($key,'<strong>'.$key.'</strong>',$item->Title,$count1);
				$tmp['Content'] = str_replace($key,'<strong>'.$key.'</strong>',$item->Content,$count2);
				$ctmp = mb_substr($item->Content,0,86,'utf8');
				if($count1 == 0 && !stripos($ctmp,$key)){
					$tmp['Content'] = stristr($item->Content,$key);
					$tmp['Content'] = str_replace($key,'<strong>'.$key.'</strong>',$tmp['Content']);
				}
				$tmp['Clicked'] = $item->Clicked;
				$tmp['Like'] = $item->Like;
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

	public function actionLike($id){
		$news = News::model()->findByPk($id);
		if(empty($news)){
			throw new CHttpException(404,'未找到页面！');
		}
		$news->Like++;
		$news->save();
		$this->redirect(array('detail','id'=>$news->Id));
	}
}
