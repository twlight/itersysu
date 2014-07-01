<?php
class Info{
	public static $Scope = array(
		'10人以下',
		'10-49人',
		'50-99人',
		'100-499人',
		'500-999人',
		'1000-4999人',
		'5000-1万人',
		'1万人以上',
	);

	public static $CompanyType = array(
		'民营企业',
		'国有企业',
		'合资企业',
		'外商独资企业',
		'股份制企业',
		'上市公司',
		'国家机关',
		'事业单位',
		'其他',
	);

	public static $Sex = array(
		'不限',
		'男',
		'女',
	);

	public static $WorkType = array(
		'全职',
		'实习',
		'兼职',
	);

	public static $Marrage = array(
		'未婚',
		'已婚',
		'保密',
	);

	public static $Edu_Corp = array(
		'不限',
		'初中及以上',
		'高中及以上',
		'大专及以上',
		'本科及以上',
		'硕士研究生及以上',
		'博士及以上',
	);

	public static $Edu_User = array(
		'初中',
		'中专',
		'高中',
		'大专',
		'本科',
		'硕士研究生',
		'博士及以上',
	);

	public static $Experience_Corp = array(
		'不限',
		'一年及以上',
		'两年及以上',
		'三年及以上',
		'四年及以上',
		'五年及以上',
		'六年及以上',
		'七年及以上',
		'八年及以上',
		'九年及以上',
		'十年及以上',
		'十五年及以上',
		'二十年及以上',
	);

	public static $Experience_User = array(
		'无经验',
		'一年',
		'两年',
		'三年',
		'四年',
		'五年',
		'六年',
		'七年',
		'八年',
		'九年',
		'十年',
		'十年以上',
		'十五年以上',
		'二十年以上',
	);

	public function getScopeByArray(){
		return self::$Scope;
	}

	public function getScope($id){
		$id = intval($id);
		if($id < 0 || $id > 7){
			return null;
		}
		return self::$Scope[$id];
	}

	public function getCompanyTypeByArray(){
		return self::$CompanyType;
	}

	public function getCompanyType($id){
		$id = intval($id);
		if($id < 0 || $id > 8){
			return null;
		}
		return self::$CompanyType[$id];
	}

	public function getSexByArray(){
		return self::$Sex;
	}

	public function getSex($id){
		$id = intval($id);
		if($id < 0 || $id > 2){
			return null;
		}
		return self::$Sex[$id];
	}

	public function getWorkTypeByArray(){
		return self::$WorkType;
	}

	public function getWorkType($id){
		$id = intval($id);
		if($id < 0 || $id > 2){
			return null;
		}
		return self::$WorkType[$id];
	}

	public function getMarrageByArray(){
		return self::$Marrage;
	}

	public function getMarrage($id){
		$id = intval($id);
		if($id < 0 || $id > 2){
			return null;
		}
		return self::$Marrage[$id];
	}

	public function getEdu_CorpByArray(){
		return self::$Edu_Corp;
	}

	public function getEdu_Corp($id){
		$id = intval($id);
		if($id < 0 || $id > 6){
			return null;
		}
		return self::$Edu_Corp[$id];
	}

	public function getExperience_CorpByArray(){
		return self::$Experience_Corp;
	}

	public function getExperience_Corp($id){
		$id = intval($id);
		if($id < 0 || $id > 12){
			return null;
		}
		return self::$Experience_Corp[$id];
	}

	public function getEdu_UserByArray(){
		return self::$Edu_User;
	}

	public function getEdu_User($id){
		$id = intval($id);
		if($id < 0 || $id > 6){
			return null;
		}
		return self::$Edu_User[$id];
	}

	public function getExperience_UserByArray(){
		return self::$Experience_User;
	}

	public function getExperience_User($id){
		$id = intval($id);
		if($id < 0 || $id > 13){
			return null;
		}
		return self::$Experience_User[$id];
	}


	public function getPublishTime($id){
		if($id == 1){
			return '3天内';
		}
		else if($id == 2){
			return '1周内';
		}
		else if($id == 3){
			return '2周内';
		}
		else if($id == 4){
			return '1月内';
		}
		else if($id == 5){
			return '3月内';
		}
		else{
			return null;
		}
	}

	public function getSelectPay($id){
		if($id == 1){
			return '面议';
		}
		else if($id == 2){
			return '1000-2000元/月';
		}
		else if($id == 3){
			return '2000-3000元/月';
		}
		else if($id == 4){
			return '3000-5000元/月';
		}
		else if($id == 5){
			return '5000-8000元/月';
		}
		else if($id == 6){
			return '8000-10000元/月';
		}
		else if($id == 7){
			return '10000-20000元/月';
		}
		else if($id == 8){
			return '2万元以上/月';
		}
		else{
			return null;
		}
	}

	public function getBusinessType($id){
		$bt = BusinessType::model()->findByPk($id);
		if(empty($bt)){
			return null;
		}
		if($bt->ParentId == 0){
			return $bt->Name;
		}
		else{
			$pbt = BusinessType::model()->findByPk($bt->ParentId);
			return $pbt->Name.' - '.$bt->Name;
		}
	}

	public function getPlace($id){
		$p = Place::model()->findByPk($id);
		if(empty($p)){
			return null;
		}
		if($p->ParentId == 0){
			return $p->Name;
		}
		else{
			$pp = Place::model()->findByPk($p->ParentId);
			return $pp->Name.' - '.$p->Name;
		}
	}
}
?>
