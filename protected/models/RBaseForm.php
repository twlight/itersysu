<?php

class RBaseForm extends CFormModel
{
	public $Name;
	public $Secret;
	public $Username;
	public $Birth;
	public $Sex;
	public $Marrage;
	public $Hukou;
	public $Address;
	public $Edu;
	public $Experience;
	public $Tel;
	public $Email;
	public $QQ;
	public $Url;
	public $Hobby;
	public $Awarded;

	public function rules()
	{
		return array(
			array('Name, Secret, Username, Birth, Sex, Marrage, Address, Edu, Experience, Tel, Email','required'),
			array('Name, Username','length','max'=>255),
			array('Secret','in','range'=>array(0,1)),
			array('Sex','in','range'=>array(1,2)),
			array('Secret, Sex, Marrage, Edu, Experience','default','value'=>0),
			array('Marrage','in','range'=>array(0,1,2)),
			array('Birth','type','type'=>'date','dateFormat'=>'yyyy-MM-dd'),
			array('Address, QQ, Hobby, Awarded, Hukou','safe'),
			array('Edu','in','range'=>array(0,1,2,3,4,5,6)),
			array('Experience','in','range'=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13)),
			array('Email','email'),
			array('Url','url'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'Name'=>'简历名称',
			'Secret'=>'是否公开',
			'Username'=>'真实姓名',
			'Birth'=>'出生日期',
			'Sex'=>'性别',
			'Marrage'=>'婚姻状况',
			'Hukou'=>'户口所在地',
			'Address'=>'常住地址',
			'Edu'=>'最高学历',
			'Experience'=>'工作经验',
			'Tel'=>'联系电话',
			'Email'=>'Email',
			'QQ'=>'QQ',
			'Url'=>'个人博客地址',
			'Hobby'=>'兴趣爱好',
			'Awarded'=>'获奖经历',
		);
	}

	public function save($id){
		if(empty($id)){
			$main = new ResumeMain;
		}
		else{
			$resume = Resume::model()->findByPk($id);
			if(empty($resume)){
				return false;
			}
			$main = ResumeMain::model()->findByPk($resume->ResumeMainId);
			if(empty($main)){
				return false;
			}
		}
		$main->attributes = $this->attributes;
		if($main->save()){
			if(!empty($id)){
				return $resume->Id;
			}
			else{
				$resume = new Resume;
				$resume->UserId = Yii::app()->user->UserId;
				$resume->Type = 0;
				$resume->ResumeMainId = $main->Id;
				$resume->ModifyTime = date('Y-m-d H:i:s');
				if($resume->save()){
					return $resume->Id;
				}
			}
		}
		return false;
	}
}
