<?php

/**
 * This is the model class for table "{{Announce}}".
 *
 * The followings are the available columns in table '{{Announce}}':
 * @property integer $Id
 * @property integer $UserId
 * @property string $City
 * @property string $School
 * @property string $Date
 * @property string $StartTime
 * @property string $EndTime
 * @property string $Address
 * @property string $Remark
 */
class Announce extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Announce the static model class
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
		return '{{Announce}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, City, Date, StartTime, EndTime, Address', 'required'),
			array('UserId', 'numerical', 'integerOnly'=>true),
			array('City, School', 'length', 'max'=>255),
			array('Remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, City, School, Date, StartTime, EndTime, Address, Remark', 'safe', 'on'=>'search'),
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
			'City' => 'City',
			'School' => 'School',
			'Date' => 'Date',
			'StartTime' => 'Start Time',
			'EndTime' => 'End Time',
			'Address' => 'Address',
			'Remark' => 'Remark',
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
		$criteria->compare('City',$this->City,true);
		$criteria->compare('School',$this->School,true);
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('StartTime',$this->StartTime,true);
		$criteria->compare('EndTime',$this->EndTime,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Remark',$this->Remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}