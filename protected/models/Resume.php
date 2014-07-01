<?php

/**
 * This is the model class for table "{{Resume}}".
 *
 * The followings are the available columns in table '{{Resume}}':
 * @property integer $Id
 * @property integer $UserId
 * @property integer $Type
 * @property integer $ResumeMainId
 * @property integer $ResumeMiniId
 * @property integer $ResumeFileId
 * @property string $ModifyTime
 */
class Resume extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resume the static model class
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
		return '{{Resume}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, ModifyTime', 'required'),
			array('UserId, Type, ResumeMainId, ResumeMiniId, ResumeFileId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, Type, ResumeMainId, ResumeMiniId, ResumeFileId, ModifyTime', 'safe', 'on'=>'search'),
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
			'Type' => 'Type',
			'ResumeMainId' => 'Resume Main',
			'ResumeMiniId' => 'Resume Mini',
			'ResumeFileId' => 'Resume File',
			'ModifyTime' => 'Modify Time',
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
		$criteria->compare('Type',$this->Type);
		$criteria->compare('ResumeMainId',$this->ResumeMainId);
		$criteria->compare('ResumeMiniId',$this->ResumeMiniId);
		$criteria->compare('ResumeFileId',$this->ResumeFileId);
		$criteria->compare('ModifyTime',$this->ModifyTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}