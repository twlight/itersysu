<?php

class JobController extends Controller
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
				'actions'=>array('search'),
				'users'=>array('*'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionSearch($key=null, $bt=null, $subbt=null, $place=null, $subplace=null, $time=null, $pay=null, $type=null, $worktype=null){
		$dataProvider=new CArrayDataProvider($this->getDataFilter($key,$bt,$subbt,$place,$subplace,$time,$pay,$type,$worktype),array(
			 'sort'=>array(
				'attributes'=>array(
					'PostTime','Pay',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		$this->render('search',array('key'=>$key,'bt'=>$bt,'subbt'=>$subbt,'place'=>$place,'subplace'=>$subplace,'time'=>$time,'pay'=>$pay,'type'=>$type,'worktype'=>$worktype,'dataProvider'=>$dataProvider));
	}

	private function getDataFilter($key, $bt, $subbt, $place, $subplace, $time, $pay, $type, $worktype){
		if(!empty($bt)){
			$businesstype = BusinessType::model()->findByPk($bt);
			if(empty($businesstype) || $businesstype->ParentId != 0){
				$bt = null;
			}
		}
		if(!empty($subbt)){
			$businesstype = BusinessType::model()->findByPk($subbt);
			if(empty($businesstype) || $businesstype->ParentId == 0){
				$subbt = null;
			}
		}
		if(!empty($place)){
			$p = Place::model()->findByPk($place);
			if(empty($p) || $p->ParentId != 0){
				$place = null;
			}
		}
		if(!empty($subplace)){
			$p = Place::model()->findByPk($subplace);
			if(empty($p) || $p->ParentId == 0){
				$subplace = null;
			}
		}
		if(!empty($time)){
			$time = intval($time);
			if($time < 1 || $time > 5){
				$time = null;
			}
		}
		if(!empty($pay)){
			$pay = intval($pay);
			if($pay < 1 || $pay > 8){
				$pay = null;
			}
		}
		if($type != null){
			$type = intval($type);
			if($type < 0 || $type > 8){
				$type = null;
			}
		}
		if($worktype != null){
			$worktype = intval($worktype);
			if($worktype < 0 || $worktype > 2){
				$worktype = null;
			}
		}

		$data = array();
		$workinfo = Workinfo::model()->findAll();
		if($key != null){
			$criteria=new CDbCriteria;
			//$criteria->addCondition('Hr LIKE "%'.$key.'%" OR Email LIKE "%'.$key.'%" OR Tel LIKE "%'.$key.'%" OR Introduction LIKE "%'.$key.'%"','OR');
			$workinfo = Workinfo::model()->findAll($criteria);
		}
		$id = 1;
		foreach($workinfo as $item){
			$criteria=new CDbCriteria;
			$criteria->addCondition("WorkinfoId=$item->Id");
			if(!empty($time)){
				switch($time){
					case 1: $criteria->addCondition('PostTime>="'.date('Y-m-d',strtotime('3 days ago')).'"');break;
					case 2: $criteria->addCondition('PostTime>="'.date('Y-m-d',strtotime('1 week ago')).'"');break;
					case 3: $criteria->addCondition('PostTime>="'.date('Y-m-d',strtotime('2 weeks ago')).'"');break;
					case 4: $criteria->addCondition('PostTime>="'.date('Y-m-d',strtotime('1 month ago')).'"');break;
					case 5: $criteria->addCondition('PostTime>="'.date('Y-m-d',strtotime('3 months ago')).'"');break;
				}
			}
			if(!empty($pay)){
				switch($pay){
					case 1: $criteria->addCondition('Pay=0');break;
					case 2: $criteria->addCondition('Pay>=1000 AND Pay<=2000');break;
					case 3: $criteria->addCondition('Pay>=2000 AND Pay<=3000');break;
					case 4: $criteria->addCondition('Pay>=3000 AND Pay<=5000');break;
					case 5: $criteria->addCondition('Pay>=5000 AND Pay<=8000');break;
					case 6: $criteria->addCondition('Pay>=8000 AND Pay<=10000');break;
					case 7: $criteria->addCondition('Pay>=10000 AND Pay<=20000');break;
					case 8: $criteria->addCondition('Pay>=20000');break;
				}
			}
			if($worktype != null){
				switch($worktype){
					case 0: $criteria->addCondition('Type=0');break;
					case 1: $criteria->addCondition('Type=1');break;
					case 2: $criteria->addCondition('Type=2');break;
				}
			}
			if($key != null){
				$criteria->addCondition('Introduction LIKE "%'.$key.'%" OR WorkName LIKE "%'.$key.'%" OR Welfare LIKE "%'.$key.'%" OR Con LIKE "%'.$key.'%"');
			}
			$detail = WorkinfoDetail::model()->findAll($criteria);
			foreach($detail as $i){
				$add = true;
				$tmp = array();
				$tmp['id'] = $id++;
				$tmp['WorkName'] = $i->WorkName;
				$company = Company::model()->findByPk($item->CompanyId);
				if(!empty($bt)){
					$businesstype = BusinessType::model()->findByPk($company->BusinessTypeId);
					if($businesstype->ParentId != 0){
						$businesstype = BusinessType::model()->findByPk($businesstype->ParentId);
					}
					if($businesstype->Id != $bt){
						$add = false;
					}
				}
				if(!empty($subbt)){
					$businesstype = BusinessType::model()->findByPk($company->BusinessTypeId);
					if($businesstype->Id != $subbt){
						$add = false;
					}
				}
				if(!empty($place)){
					$p = Place::model()->findByPk($company->PlaceId);
					if($p->ParentId != 0){
						$p = BusinessType::model()->findByPk($p->ParentId);
					}
					if($p->Id != $place){
						$add = false;
					}
				}
				if(!empty($subplace)){
					$p = Place::model()->findByPk($company->PlaceId);
					if($p->Id != $subplace){
						$add = false;
					}
				}
				if($type != null){
					if($company->Type != $type){
						$add = false;
					}
				}
				$tmp['CompanyName'] = $company->CompanyName;
				$tmp['ZhaoPin_Place'] = $i->ZhaoPin_Place;
				$tmp['PostTime'] = $i->PostTime;
				$tmp['OfferNum'] = $i->OfferNum;
				$tmp['Pay'] = $i->Pay;
				$tmp['Type'] = $company->Type;
				$tmp['Experience'] = $i->Experience;
				$tmp['Edu'] = $i->Edu;
				$tmp['Introduction'] = $i->Introduction;
				$tmp['WorkinfoDetailId'] = $i->Id;
				$tmp['WorkinfoId'] = $i->WorkinfoId;
				$tmp['did'] = $i->Id;
				if($add){
					array_push($data,$tmp);
				}
			}
		}
		return $data;
	}
}
