<?php

/**
 * This is the model class for table "{{NComment}}".
 *
 * The followings are the available columns in table '{{NComment}}':
 * @property integer $Id
 * @property integer $UserId
 * @property integer $NewsId
 * @property string $Content
 * @property string $PostTime
 * @property integer $ParentId
 */
class NComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NComment the static model class
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
		return '{{NComment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, NewsId, Content, PostTime', 'required'),
			array('UserId, NewsId, ParentId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, UserId, NewsId, Content, PostTime, ParentId', 'safe', 'on'=>'search'),
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
			'NewsId' => 'News',
			'Content' => 'Content',
			'PostTime' => 'Post Time',
			'ParentId' => 'Parent',
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
		$criteria->compare('NewsId',$this->NewsId);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('PostTime',$this->PostTime,true);
		$criteria->compare('ParentId',$this->ParentId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}