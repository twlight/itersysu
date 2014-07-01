<?php

class REduForm extends CFormModel
{
	public $StartDate;
	public $EndDate;
	public $SchoolName;
	public $SpecialtyName;
	public $EduBak;
	public $REdu;

	public function rules()
	{
		return array(
			array('StartDate, EndDate, SchoolName, EduBak','required'),
			array('StartDate, EndDate, SchoolName, SpecialtyName, EduBak','type','type'=>'array'),
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
			'SchoolName'=>'学校名称',
			'SpecialtyName'=>'专业名称',
			'EduBak'=>'学历',
		);
	}

	public function validate2(){
		if(!$this->validate()){
			return false;
		}
		if(count($this->StartDate) != count($this->EndDate)){
			$this->addError('EndDate','StartDate and EndDate must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->SchoolName)){
			$this->addError('SchoolName','SchoolName must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->SpecialtyName)){
			$this->addError('SpecialtyName','SpecialtyName must be an array.');
			return false;
		}
		if(count($this->StartDate) != count($this->EduBak)){
			$this->addError('EduBak','Edu must be an array.');
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
		foreach($this->EduBak as $item){
			if($item < 0 || $item > 8){
				$this->addError('EduBak','Edu must be the given value.');
				return false;
			}
		}
		return true;
	}

	public function save($id){
		$rdu = REdu::model()->deleteAll('ResumeMainId=:Id',array(':Id'=>$id));
		for($i=0;$i<count($this->StartDate);$i++){
			$edu = new REdu;
			$edu->ResumeMainId = $id;
			$edu->StartDate = $this->StartDate[$i];
			$edu->EndDate = $this->EndDate[$i];
			$edu->SchoolName = $this->SchoolName[$i];
			$edu->SpecialtyName = $this->SpecialtyName[$i];
			$edu->Edu = $this->EduBak[$i];
			$edu->save();
		}
		return true;
	}
}
