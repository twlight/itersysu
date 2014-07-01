<?php

/**
 * This is the model class for table "{{ResumeMain}}".
 *
 * The followings are the available columns in table '{{ResumeMain}}':
 * @property integer $Id
 * @property string $Name
 * @property integer $Secret
 * @property string $Username
 * @property string $Birth
 * @property integer $Sex
 * @property integer $Marrage
 * @property string $Hukou
 * @property string $Address
 * @property integer $Edu
 * @property integer $Experience
 * @property string $Tel
 * @property string $Email
 * @property string $QQ
 * @property string $Url
 * @property string $Hobby
 * @property string $Img
 * @property string $Awarded
 */
class ResumeMain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResumeMain the static model class
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
		return '{{ResumeMain}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Username, Birth, Address, Tel, Email', 'required'),
			array('Secret, Sex, Marrage, Edu, Experience', 'numerical', 'integerOnly'=>true),
			array('Name, Username, Tel, Email, QQ, Url, Img', 'length', 'max'=>255),
			array('Hukou, Hobby, Awarded', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Name, Secret, Username, Birth, Sex, Marrage, Hukou, Address, Edu, Experience, Tel, Email, QQ, Url, Hobby, Img, Awarded', 'safe', 'on'=>'search'),
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
			'Name' => 'Name',
			'Secret' => 'Secret',
			'Username' => 'Username',
			'Birth' => 'Birth',
			'Sex' => 'Sex',
			'Marrage' => 'Marrage',
			'Hukou' => 'Hukou',
			'Address' => 'Address',
			'Edu' => 'Edu',
			'Experience' => 'Experience',
			'Tel' => 'Tel',
			'Email' => 'Email',
			'QQ' => 'Qq',
			'Url' => 'Url',
			'Hobby' => 'Hobby',
			'Img' => 'Img',
			'Awarded' => 'Awarded',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Secret',$this->Secret);
		$criteria->compare('Username',$this->Username,true);
		$criteria->compare('Birth',$this->Birth,true);
		$criteria->compare('Sex',$this->Sex);
		$criteria->compare('Marrage',$this->Marrage);
		$criteria->compare('Hukou',$this->Hukou,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Edu',$this->Edu);
		$criteria->compare('Experience',$this->Experience);
		$criteria->compare('Tel',$this->Tel,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('Url',$this->Url,true);
		$criteria->compare('Hobby',$this->Hobby,true);
		$criteria->compare('Img',$this->Img,true);
		$criteria->compare('Awarded',$this->Awarded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}