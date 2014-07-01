<?php

/**
 * This is the model class for table "{{ShareAudition}}".
 *
 * The followings are the available columns in table '{{ShareAudition}}':
 * @property integer $Id
 * @property integer $UserId
 * @property string $CompanyName
 * @property string $PostName
 * @property string $Place
 * @property string $AuditionTime
 * @property integer $CostTime
 * @property string $Process
 * @property string $Question
 * @property integer $Way
 * @property integer $Method
 * @property integer $Difficulty
 * @property integer $Feel
 * @property string $PostTime
 */
class ShareAudition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShareAudition the static model class
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
		return '{{ShareAudition}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, CompanyName, PostName, Place, CostTime, Process, Question, Way, Method, Difficulty, Feel, PostTime', 'required'),
			array('UserId, CostTime, Way, Method, Difficulty, Feel', 'numerical', 'integerOnly'=>true),
			array('CompanyName, PostName', 'length', 'max'=>255),
			array('AuditionTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, CompanyName, PostName, Place, AuditionTime, CostTime, Process, Question, Way, Method, Difficulty, Feel, PostTime', 'safe', 'on'=>'search'),
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
			'CompanyName' => 'Company Name',
			'PostName' => 'Post Name',
			'Place' => 'Place',
			'AuditionTime' => 'Audition Time',
			'CostTime' => 'Cost Time',
			'Process' => 'Process',
			'Question' => 'Question',
			'Way' => 'Way',
			'Method' => 'Method',
			'Difficulty' => 'Difficulty',
			'Feel' => 'Feel',
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
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('CompanyName',$this->CompanyName,true);
		$criteria->compare('PostName',$this->PostName,true);
		$criteria->compare('Place',$this->Place,true);
		$criteria->compare('AuditionTime',$this->AuditionTime,true);
		$criteria->compare('CostTime',$this->CostTime);
		$criteria->compare('Process',$this->Process,true);
		$criteria->compare('Question',$this->Question,true);
		$criteria->compare('Way',$this->Way);
		$criteria->compare('Method',$this->Method);
		$criteria->compare('Difficulty',$this->Difficulty);
		$criteria->compare('Feel',$this->Feel);
		$criteria->compare('PostTime',$this->PostTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}