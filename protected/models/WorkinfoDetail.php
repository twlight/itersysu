<?php

/**
 * This is the model class for table "{{WorkinfoDetail}}".
 *
 * The followings are the available columns in table '{{WorkinfoDetail}}':
 * @property integer $Id
 * @property integer $WorkinfoId
 * @property string $WorkName
 * @property integer $OfferNum
 * @property integer $Edu
 * @property integer $Experience
 * @property integer $Sex
 * @property string $Age
 * @property string $ZhaoPin_Place
 * @property string $WorkPlace
 * @property integer $Pay
 * @property integer $Type
 * @property string $Introduction
 * @property string $Con
 * @property string $Welfare
 * @property string $PostTime
 */
class WorkinfoDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkinfoDetail the static model class
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
		return '{{WorkinfoDetail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('WorkinfoId, WorkName, WorkPlace', 'required'),
			array('WorkinfoId, OfferNum, Edu, Experience, Sex, Pay, Type', 'numerical', 'integerOnly'=>true),
			array('WorkName, Age, ZhaoPin_Place, WorkPlace', 'length', 'max'=>255),
			array('Introduction, Con, Welfare, PostTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, WorkinfoId, WorkName, OfferNum, Edu, Experience, Sex, Age, ZhaoPin_Place, WorkPlace, Pay, Type, Introduction, Con, Welfare, PostTime', 'safe', 'on'=>'search'),
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
			'WorkinfoId' => 'Workinfo',
			'WorkName' => 'Work Name',
			'OfferNum' => 'Offer Num',
			'Edu' => 'Edu',
			'Experience' => 'Experience',
			'Sex' => 'Sex',
			'Age' => 'Age',
			'ZhaoPin_Place' => 'Zhao Pin Place',
			'WorkPlace' => 'Work Place',
			'Pay' => 'Pay',
			'Type' => 'Type',
			'Introduction' => 'Introduction',
			'Con' => 'Con',
			'Welfare' => 'Welfare',
			'PostTime' => 'Post Time',
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
		$criteria->compare('WorkinfoId',$this->WorkinfoId);
		$criteria->compare('WorkName',$this->WorkName,true);
		$criteria->compare('OfferNum',$this->OfferNum);
		$criteria->compare('Edu',$this->Edu);
		$criteria->compare('Experience',$this->Experience);
		$criteria->compare('Sex',$this->Sex);
		$criteria->compare('Age',$this->Age,true);
		$criteria->compare('ZhaoPin_Place',$this->ZhaoPin_Place,true);
		$criteria->compare('WorkPlace',$this->WorkPlace,true);
		$criteria->compare('Pay',$this->Pay);
		$criteria->compare('Type',$this->Type);
		$criteria->compare('Introduction',$this->Introduction,true);
		$criteria->compare('Con',$this->Con,true);
		$criteria->compare('Welfare',$this->Welfare,true);
		$criteria->compare('PostTime',$this->PostTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}