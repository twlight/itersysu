<?php

/**
 * This is the model class for table "{{RProject}}".
 *
 * The followings are the available columns in table '{{RProject}}':
 * @property integer $Id
 * @property integer $ResumeMainId
 * @property string $Name
 * @property string $Role
 * @property string $Introduction
 * @property string $Content
 */
class RProject extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RProject the static model class
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
		return '{{RProject}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ResumeMainId, Name, Role, Introduction, Content', 'required'),
			array('ResumeMainId', 'numerical', 'integerOnly'=>true),
			array('Name, Role', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ResumeMainId, Name, Role, Introduction, Content', 'safe', 'on'=>'search'),
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
			'ResumeMainId' => 'Resume Main',
			'Name' => 'Name',
			'Role' => 'Role',
			'Introduction' => 'Introduction',
			'Content' => 'Content',
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
		$criteria->compare('ResumeMainId',$this->ResumeMainId);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Role',$this->Role,true);
		$criteria->compare('Introduction',$this->Introduction,true);
		$criteria->compare('Content',$this->Content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}