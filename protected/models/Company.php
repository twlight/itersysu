<?php

/**
 * This is the model class for table "{{Company}}".
 *
 * The followings are the available columns in table '{{Company}}':
 * @property integer $Id
 * @property string $CompanyName
 * @property integer $StartYear
 * @property integer $RegisteredCapital
 * @property integer $Scope
 * @property integer $Type
 * @property integer $BusinessTypeId
 * @property string $Url
 * @property integer $PlaceId
 * @property string $Img
 * @property string $Email
 * @property string $Tel
 * @property string $Address
 * @property string $Introduction
 * @property integer $UserId
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Company}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CompanyName, UserId', 'required'),
			array('StartYear, RegisteredCapital, Scope, Type, BusinessTypeId, PlaceId, UserId', 'numerical', 'integerOnly'=>true),
			array('CompanyName, Url, Email, Tel, Address', 'length', 'max'=>255),
			array('Img, Introduction', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, CompanyName, StartYear, RegisteredCapital, Scope, Type, BusinessTypeId, Url, PlaceId, Img, Email, Tel, Address, Introduction, UserId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'CompanyName' => 'Company Name',
			'StartYear' => 'Start Year',
			'RegisteredCapital' => 'Registered Capital',
			'Scope' => 'Scope',
			'Type' => 'Type',
			'BusinessTypeId' => 'Business Type',
			'Url' => 'Url',
			'PlaceId' => 'Place',
			'Img' => 'Img',
			'Email' => 'Email',
			'Tel' => 'Tel',
			'Address' => 'Address',
			'Introduction' => 'Introduction',
			'UserId' => 'User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('CompanyName',$this->CompanyName,true);
		$criteria->compare('StartYear',$this->StartYear);
		$criteria->compare('RegisteredCapital',$this->RegisteredCapital);
		$criteria->compare('Scope',$this->Scope);
		$criteria->compare('Type',$this->Type);
		$criteria->compare('BusinessTypeId',$this->BusinessTypeId);
		$criteria->compare('Url',$this->Url,true);
		$criteria->compare('PlaceId',$this->PlaceId);
		$criteria->compare('Img',$this->Img,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Tel',$this->Tel,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Introduction',$this->Introduction,true);
		$criteria->compare('UserId',$this->UserId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}