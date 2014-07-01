<?php

class PositionForm extends CFormModel
{
	public $WorkName;
	public $Edu;
	public $Experience;
	public $Sex;
	public $Age;
	public $WorkPlace;
	public $Pay;
	public $Introduction;
	public $Con;
	public $Welfare;

	public function rules()
	{
		return array(
			array('WorkName, Edu, Experience, Sex, Age, WorkPlace, Pay','required'),
			array('WorkName, Age, WorkPlace','length','max'=>255),
			array('Edu','in','range'=>array(0,1,2,3,4,5,6)),
			array('Experience','in','range'=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13)),
			array('Sex','in','range'=>array(0,1,2)),
			array('Pay','numerical','min'=>0),
			array('Introduction, Con, Welfare','safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'WorkName'=>'职位名',
			'Edu'=>'学历要求',
			'Experience'=>'工作经验要求',
			'Sex'=>'性别要求',
			'Age'=>'年龄要求',
			'WorkPlace'=>'工作地点',
			'Pay'=>'工资',
			'Introduction'=>'职位简介',
			'Con'=>'应聘条件',
			'Welfare'=>'福利待遇',
		);
	}

	public function save($id){
		$model = new Position;
		if(!empty($id)){
			$model = Position::model()->findByPk($id);
			if(empty($model)){
				throw new CHttpException(403,'Access deny.');
			}
			else if($model->UserId != Yii::app()->user->UserId){
				throw new CHttpException(403,'Access deny.');
			}
		}
		$model->UserId = Yii::app()->user->UserId;
		$model->attributes = $this->attributes;
		$model->save();
		return true;
	}
}
