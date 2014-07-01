<?php

/**
 * This is the model class for table "{{Workinfo}}".
 *
 * The followings are the available columns in table '{{Workinfo}}':
 * @property integer $Id
 * @property integer $CompanyId
 * @property string $Hr
 * @property string $Email
 * @property string $Tel
 * @property string $EndTime
 * @property string $Introduction
 * @property integer $Verify
 */
class Workinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workinfo the static model class
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
		return '{{Workinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CompanyId, Hr, EndTime', 'required'),
			array('CompanyId, Verify', 'numerical', 'integerOnly'=>true),
			array('Hr, Email, Tel', 'length', 'max'=>255),
			array('Introduction', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, CompanyId, Hr, Email, Tel, EndTime, Introduction, Verify', 'safe', 'on'=>'search'),
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
			'CompanyId' => 'Company',
			'Hr' => 'Hr',
			'Email' => 'Email',
			'Tel' => 'Tel',
			'EndTime' => 'End Time',
			'Introduction' => 'Introduction',
			'Verify' => 'Verify',
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
		$criteria->compare('CompanyId',$this->CompanyId);
		$criteria->compare('Hr',$this->Hr,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Tel',$this->Tel,true);
		$criteria->compare('EndTime',$this->EndTime,true);
		$criteria->compare('Introduction',$this->Introduction,true);
		$criteria->compare('Verify',$this->Verify);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}