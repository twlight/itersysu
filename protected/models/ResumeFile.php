<?php

/**
 * This is the model class for table "{{ResumeFile}}".
 *
 * The followings are the available columns in table '{{ResumeFile}}':
 * @property integer $Id
 * @property string $Name
 * @property string $Filename
 * @property string $RealFilename
 * @property string $Username
 * @property integer $Sex
 * @property integer $Edu
 * @property integer $Experience
 * @property string $Content
 */
class ResumeFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResumeFile the static model class
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
		return '{{ResumeFile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Filename, RealFilename, Username', 'required'),
			array('Sex, Edu, Experience', 'numerical', 'integerOnly'=>true),
			array('Name, Filename, RealFilename, Username', 'length', 'max'=>255),
			array('Content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Name, Filename, RealFilename, Username, Sex, Edu, Experience, Content', 'safe', 'on'=>'search'),
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
			'Filename' => 'Filename',
			'RealFilename' => 'Real Filename',
			'Username' => 'Username',
			'Sex' => 'Sex',
			'Edu' => 'Edu',
			'Experience' => 'Experience',
			'Content' => 'Content',
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
		$criteria->compare('Filename',$this->Filename,true);
		$criteria->compare('RealFilename',$this->RealFilename,true);
		$criteria->compare('Username',$this->Username,true);
		$criteria->compare('Sex',$this->Sex);
		$criteria->compare('Edu',$this->Edu);
		$criteria->compare('Experience',$this->Experience);
		$criteria->compare('Content',$this->Content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}