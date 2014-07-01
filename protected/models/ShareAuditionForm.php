<?php

class ShareAuditionForm extends CFormModel
{
	public $CompanyName;
	public $PostName;
	public $Place;
	public $AuditionTime;
	public $CostTime;
	public $Process;
	public $Question;
	public $Way;
	public $Method;
	public $Difficulty;
	public $Feel;

	public function rules()
	{
			return array(
			array('CompanyName, PostName, Place, CostTime, Process, Question, Way, Method, Difficulty, Feel', 'required'),
			array('CompanyName, PostName', 'length','max'=>255),
			array('AuditionTime','type','type'=>'date','dateFormat'=>'yyyy-MM-dd'),
			array('CostTime','numerical','min'=>0),
			array('Way','in','range'=>array(0,1,2)),
			array('Method, Feel','in','range'=>array(0,1,2,3)),
			array('Difficulty','in','range'=>array(0,1,2,3,4)),
			array('Place, Process, Question','safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'CompanyName'=>'公司名',
			'PostName'=>'应聘职位名',
			'Place'=>'面试城市',
			'AuditionTime'=>'面试日期',
			'CostTime'=>'面试花费时间',
			'Process'=>'面试过程',
			'Question'=>'面试官提到的问题',
			'Way'=>'应聘途径',
			'Method'=>'面试形式',
			'Difficulty'=>'面试难度',
			'Feel'=>'面试感觉',
		);
	}

	public function save(){
		$model = new ShareAudition;
		$model->UserId = Yii::app()->user->UserId;
		$model->CompanyName = $this->CompanyName;
		$model->PostName = $this->PostName;
		$model->Place = $this->Place;
		$model->AuditionTime = $this->AuditionTime;
		$model->CostTime = $this->CostTime;
		$model->Process = $this->Process;
		$model->Question = $this->Question;
		$model->Way = $this->Way;
		$model->Method = $this->Method;
		$model->Difficulty = $this->Difficulty;
		$model->Feel = $this->Feel;
		$model->PostTime = date('Y-m-d H:i:s');
		if($model->save()){
			return true;
		}
		return false;
	}
}
