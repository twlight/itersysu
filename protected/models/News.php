<?php

/**
 * This is the model class for table "{{News}}".
 *
 * The followings are the available columns in table '{{News}}':
 * @property integer $Id
 * @property integer $UserId
 * @property string $Title
 * @property string $Content
 * @property integer $SortId
 * @property integer $Clicked
 * @property integer $Like
 * @property string $PostTime
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return '{{News}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, Title, Content, SortId, PostTime', 'required'),
			array('UserId, SortId, Clicked, Like', 'numerical', 'integerOnly'=>true),
			array('Title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, Title, Content, SortId, Clicked, Like, PostTime', 'safe', 'on'=>'search'),
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
			'Title' => 'Title',
			'Content' => 'Content',
			'SortId' => 'Sort',
			'Clicked' => 'Clicked',
			'Like' => 'Like',
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
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('SortId',$this->SortId);
		$criteria->compare('Clicked',$this->Clicked);
		$criteria->compare('Like',$this->Like);
		$criteria->compare('PostTime',$this->PostTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}