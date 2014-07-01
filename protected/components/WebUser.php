<?php  
class WebUser extends CWebUser {
	public function getIsGuest() {
		return !isset(Yii::app()->user->Email);
	}

	public function isInfoCompe(){
		if(Yii::app()->user->isGuest){
			return false;
		}
		if(Yii::app()->user->UserType != 1){
			return false;
		}
		$company = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
		if(empty($company->StartYear) || empty($company->RegisteredCapital)){
			return false;
		}
		return true;
	}
}
?>
