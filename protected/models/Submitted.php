<?php

/**
 * This is the model class for table "{{Submitted}}".
 *
 * The followings are the available columns in table '{{Submitted}}':
 * @property integer $Id
 * @property integer $UserId
 * @property integer $WorkinfoDetailId
 * @property integer $ResumeId
 * @property string $Time
 * @property integer $Processed
 */
class Submitted extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Submitted the static model class
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
		return '{{Submitted}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, WorkinfoDetailId, ResumeId, Time', 'required'),
			array('UserId, WorkinfoDetailId, ResumeId, Processed', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, WorkinfoDetailId, ResumeId, Time, Processed', 'safe', 'on'=>'search'),
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
			'UserId' => 'User',
			'WorkinfoDetailId' => 'Workinfo Detail',
			'ResumeId' => 'Resume',
			'Time' => 'Time',
			'Processed' => 'Processed',
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
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('WorkinfoDetailId',$this->WorkinfoDetailId);
		$criteria->compare('ResumeId',$this->ResumeId);
		$criteria->compare('Time',$this->Time,true);
		$criteria->compare('Processed',$this->Processed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}