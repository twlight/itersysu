<?php

/**
 * This is the model class for table "{{REdu}}".
 *
 * The followings are the available columns in table '{{REdu}}':
 * @property integer $Id
 * @property integer $ResumeMainId
 * @property string $StartDate
 * @property string $EndDate
 * @property string $SchoolName
 * @property string $SpecialtyName
 * @property integer $Edu
 */
class REdu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return REdu the static model class
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
		return '{{REdu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ResumeMainId, StartDate, EndDate, SchoolName', 'required'),
			array('ResumeMainId, Edu', 'numerical', 'integerOnly'=>true),
			array('SchoolName, SpecialtyName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ResumeMainId, StartDate, EndDate, SchoolName, SpecialtyName, Edu', 'safe', 'on'=>'search'),
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
			'StartDate' => 'Start Date',
			'EndDate' => 'End Date',
			'SchoolName' => 'School Name',
			'SpecialtyName' => 'Specialty Name',
			'Edu' => 'Edu',
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
		$criteria->compare('StartDate',$this->StartDate,true);
		$criteria->compare('EndDate',$this->EndDate,true);
		$criteria->compare('SchoolName',$this->SchoolName,true);
		$criteria->compare('SpecialtyName',$this->SpecialtyName,true);
		$criteria->compare('Edu',$this->Edu);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}