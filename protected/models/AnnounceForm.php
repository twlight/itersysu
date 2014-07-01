<?php

class AnnounceForm extends CFormModel
{
	public $City;
	public $School;
	public $Date;
	public $StartTime;
	public $EndTime;
	public $Address;
	public $Remark;

	public function rules()
	{
		return array(
			array('City, Date, StartTime, EndTime, Address','required'),
			array('Date','type','type'=>'date','dateFormat'=>'yyyy-MM-dd'),
			array('StartTime, EndTime','type','type'=>'time','timeFormat'=>'hh:mm:ss','message'=>'时间格式必须为00:00:00'),
			array('City, School, Address, Remark','safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'City'=>'城市',
			'School'=>'举办学校',
			'Date'=>'日期',
			'StartTime'=>'开始时间',
			'EndTime'=>'结束时间',
			'Address'=>'地址',
			'Remark'=>'备注',
		);
	}

	public function save(){
		$model = new Announce;
		$model->UserId = Yii::app()->user->UserId;
		$model->attributes = $this->attributes;
		$model->save();
		return true;
	}
}
