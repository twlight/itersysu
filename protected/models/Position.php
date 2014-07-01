<?php

/**
 * This is the model class for table "{{Position}}".
 *
 * The followings are the available columns in table '{{Position}}':
 * @property integer $Id
 * @property integer $UserId
 * @property string $WorkName
 * @property integer $Edu
 * @property integer $Experience
 * @property integer $Sex
 * @property string $Age
 * @property string $WorkPlace
 * @property integer $Pay
 * @property string $Introduction
 * @property string $Con
 * @property string $Welfare
 */
class Position extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Position the static model class
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
		return '{{Position}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, WorkName, Age, WorkPlace', 'required'),
			array('UserId, Edu, Experience, Sex, Pay', 'numerical', 'integerOnly'=>true),
			array('WorkName, Age, WorkPlace', 'length', 'max'=>255),
			array('Introduction, Con, Welfare', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, WorkName, Edu, Experience, Sex, Age, WorkPlace, Pay, Introduction, Con, Welfare', 'safe', 'on'=>'search'),
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
			'WorkName' => 'Work Name',
			'Edu' => 'Edu',
			'Experience' => 'Experience',
			'Sex' => 'Sex',
			'Age' => 'Age',
			'WorkPlace' => 'Work Place',
			'Pay' => 'Pay',
			'Introduction' => 'Introduction',
			'Con' => 'Con',
			'Welfare' => 'Welfare',
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
		$criteria->compare('WorkName',$this->WorkName,true);
		$criteria->compare('Edu',$this->Edu);
		$criteria->compare('Experience',$this->Experience);
		$criteria->compare('Sex',$this->Sex);
		$criteria->compare('Age',$this->Age,true);
		$criteria->compare('WorkPlace',$this->WorkPlace,true);
		$criteria->compare('Pay',$this->Pay);
		$criteria->compare('Introduction',$this->Introduction,true);
		$criteria->compare('Con',$this->Con,true);
		$criteria->compare('Welfare',$this->Welfare,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}