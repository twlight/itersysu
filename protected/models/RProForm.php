<?php

class RProForm extends CFormModel
{
	public $Name;
	public $Role;
	public $Introduction;
	public $Content;
	public $RPro;

	public function rules()
	{
		return array(
			array('Name, Role, Introduction, Content','required'),
			array('Name, Role, Introduction, Content','type','type'=>'array'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'Name'=>'项目名称',
			'Role'=>'担任角色',
			'Introduction'=>'项目简介',
			'Content'=>'个人贡献',
		);
	}

	public function validate2(){
		if(!$this->validate()){
			return false;
		}
		if(count($this->Name) != count($this->Role)){
			$this->addError('Role','Role must be an array.');
			return false;
		}
		if(count($this->Name) != count($this->Introduction)){
			$this->addError('Introduction','Introduction must be an array.');
			return false;
		}
		if(count($this->Name) != count($this->Content)){
			$this->addError('SpecialtyName','SpecialtyName must be an array.');
			return false;
		}
		return true;
	}

	public function save($id){
		RProject::model()->deleteAll('ResumeMainId=:Id',array(':Id'=>$id));
		for($i=0;$i<count($this->Name);$i++){
			$pro = new RProject;
			$pro->Name = $this->Name[$i];
			$pro->Role = $this->Role[$i];
			$pro->Introduction = $this->Introduction[$i];
			$pro->Content = $this->Content[$i];
			$pro->ResumeMainId = $id;
			$pro->save();
		}
		return true;
	}
}
