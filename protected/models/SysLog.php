<?php

/**
 * This is the model class for table "{{SysLog}}".
 *
 * The followings are the available columns in table '{{SysLog}}':
 * @property integer $Id
 * @property integer $UserId
 * @property integer $Type
 * @property string $Ip
 * @property string $Time
 * @property string $Comtent
 */
class SysLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SysLog the static model class
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
		return '{{SysLog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, Time', 'required'),
			array('UserId, Type', 'numerical', 'integerOnly'=>true),
			array('Ip', 'length', 'max'=>255),
			array('Comtent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, Type, Ip, Time, Comtent', 'safe', 'on'=>'search'),
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
			'Ip' => 'Ip',
			'Time' => 'Time',
			'Comtent' => 'Comtent',
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
		$criteria->compare('Ip',$this->Ip,true);
		$criteria->compare('Time',$this->Time,true);
		$criteria->compare('Comtent',$this->Comtent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}