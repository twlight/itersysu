<?php

class CorpForm extends CFormModel
{
	public $CompanyName;
	public $StartYear;
	public $RegisteredCapital;
	public $Scope;
	public $Type;
	public $BusinessTypeId;
	public $Url;
	public $PlaceId;
	public $Img;
	public $Email;
	public $Tel;
	public $Address;
	public $Introduction;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('CompanyName, StartYear, RegisteredCapital, Scope, Type, BusinessTypeId, PlaceId, Email, Tel','required'),
			array('CompanyName, Img, Tel, Address','length','max'=>255),
			array('StartYear','numerical','integerOnly'=>true,'min'=>1800,'max'=>intval(date('Y'))),
			array('RegisteredCapital','numerical','integerOnly'=>true),
			array('Scope','in','range'=>array('0','1','2','3','4','5','6','7')),
			array('Type','in','range'=>array('0','1','2','3','4','5','6','7','8','9')),
			array('BusinessTypeId','exist','className'=>'BusinessType','attributeName'=>'Id'),
			array('Url','url'),
			array('PlaceId','exist','className'=>'Place','attributeName'=>'Id'),
			array('Email','email'),
			array('Introduction','default','value'=>''),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'CompanyName'=>'公司名称',
			'StartYear'=>'建立年份',
			'RegisteredCapital'=>'注册资金',
			'Scope'=>'公司规模',
			'Type'=>'公司类型',
			'BusinessTypeId'=>'所属行业',
			'Url'=>'公司网站',
			'PlaceId'=>'所属地区',
			'Img'=>'公司标识',
			'Email'=>'Email',
			'Tel'=>'联系电话',
			'Address'=>'联系地址',
			'Introduction'=>'公司简介',
		);
	}

	public function save(){
		$company = Company::model()->find('UserId=:UserId',array(':UserId'=>Yii::app()->user->UserId));
		$company->CompanyName = $this->CompanyName;
		$company->StartYear = $this->StartYear;
		$company->RegisteredCapital = $this->RegisteredCapital;
		$company->Scope = $this->Scope;
		$company->Type = $this->Type;
		$company->BusinessTypeId = $this->BusinessTypeId;
		$company->Url = $this->Url;
		$company->PlaceId = $this->PlaceId;
		$company->Img = $this->Img;
		$company->Email = $this->Email;
		$company->Tel = $this->Tel;
		$company->Address = $this->Address;
		$company->Introduction = $this->Introduction;
		$company->save();
		return true;
	}
}
