<?php

class RExpForm extends CFormModel
{
	public $StartDate;
	public $EndDate;
	public $CompanyName;
	public $Type;
	public $CompanyType;
	public $CompanyScope;
	public $PostName;
	public $WorkContent;
	public $RExp;

	public function rules()
	{
		return array(
			array('StartDate, EndDate, CompanyName, Type, CompanyType, CompanyScope, PostName, WorkContent','required'),
			array('StartDate, EndDate, CompanyName, Type, CompanyType, CompanyScope, PostName, WorkContent','type','type'=>'array'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'StartDate'=>'开始日期',
			'EndDate'=>'结束日期',
			'CompanyName'=>'公司名称',
			'Type'=>'工作类型',
			'CompanyType'=>'公司类型',
			'CompanyScope'=>'公司规模',
			'PostName'=>'职位名称',
			'WorkContent'=>'工作内容',
		);
	}

	public function validate2(){
		if(!$this->validate()){
			return false;
		}
		if(count($this->StartDate) != count($this->EndDate)){
			$this->addError('EndDate','StartDate or EndDate must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->CompanyName)){
			$this->addError('CompanyName','CompanyName must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->Type)){
			$this->addError('Type','Type must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->CompanyType)){
			$this->addError('CompanyType','CompanyType must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->CompanyScope)){
			$this->addError('CompanyScope','CompanyScope must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->PostName)){
			$this->addError('PostName','PostName must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->WorkContent)){
			$this->addError('WorkContent','WorkContent must be an array.');
			return false;
		}
		foreach($this->StartDate as $item){
			$d = strtotime($item);
			if(empty($d)){
				$this->addError('StartDate',$item.' Date format error.');
				return false;
			}
		}
		foreach($this->EndDate as $item){
			$d = strtotime($item);
			if(empty($d)){
				$this->addError('EndDate',$item.' Date format error.');
				return false;
			}
		}
		foreach($this->Type as $item){
			if($item < 0 || $item > 2){
				$this->addError('Type','Type must be the given value.');
				return false;
			}
		}
		foreach($this->CompanyType as $item){
			if($item < 0 || $item > 8){
				$this->addError('CompanyType','CompanyType must be the given value.');
				return false;
			}
		}
		foreach($this->CompanyScope as $item){
			if($item < 0 || $item > 7){
				$this->addError('CompanyScope','CompanyScope must be the given value.');
				return false;
			}
		}
		return true;
	}

	public function save($id){
		RExperience::model()->deleteAll('ResumeMainId=:ResumeMainId',array(':ResumeMainId'=>$id));
		for($i=0;$i<count($this->StartDate);$i++){
			$exp = new RExperience;
			$exp->ResumeMainId = $id;
			$exp->StartDate = $this->StartDate[$i];
			$exp->EndDate = $this->EndDate[$i];
			$exp->CompanyName = $this->CompanyName[$i];
			$exp->Type = $this->Type[$i];
			$exp->CompanyType = $this->CompanyType[$i];
			$exp->CompanyScope = $this->CompanyScope[$i];
			$exp->PostName = $this->PostName[$i];
			$exp->WorkContent = $this->WorkContent[$i];
			$exp->save();
		}
		return true;
	}
}
