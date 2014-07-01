<?php

/**
 * This is the model class for table "{{Favourite}}".
 *
 * The followings are the available columns in table '{{Favourite}}':
 * @property integer $Id
 * @property integer $UserId
 * @property integer $WorkinfoDetailId
 * @property string $Time
 */
class Favourite extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Favourite the static model class
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
		return '{{Favourite}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, WorkinfoDetailId, Time', 'required'),
			array('UserId, WorkinfoDetailId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, WorkinfoDetailId, Time', 'safe', 'on'=>'search'),
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
			'Time' => 'Time',
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
		$criteria->compare('Time',$this->Time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}