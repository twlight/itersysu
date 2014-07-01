<?php

class WorkinfoForm extends CFormModel
{
	public $Hr;
	public $Email;
	public $Tel;
	public $EndTime;
	public $Introduction;
	public $Detail;

	public $position;

	public function rules()
	{
		return array(
			array('Hr, Email, Tel, EndTime, Detail', 'required'),
			array('Hr, Tel','length','max'=>255),
			array('Email','email'),
			array('EndTime','type','type'=>'datetime','datetimeFormat'=>'yyyy-MM-dd hh:mm:ss'),
			array('Introduction','safe'),
			array('Detail','type','type'=>'array'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'Hr'=>'联系人',
			'Email'=>'Email',
			'Tel'=>'联系电话',
			'EndTime'=>'截止时间',
			'Introduction'=>'招聘简介',
		);
	}

	public function validate2(){
		if(!isset($this->Detail)){
			$this->addError('Detail','职位不能为空.');
			return false;
		}
		if(!isset($this->Detail['Checked'])){
			$this->addError('Detail','(checked)职位不能为空.');
			return false;
		}
		if(!isset($this->Detail['ZhaoPin_Place'])){
			$this->addError('Detail','(ZhaoPin_Place)职位不能为空.');
			return false;
		}
		if(!isset($this->Detail['Type'])){
			$this->addError('Detail','(Type)职位不能为空.');
			return false;
		}
		if(count($this->position) != count($this->Detail['Checked'])){
			$this->addError('Detail','(Checked)非法操作.'.count($this->Detail['Checked']));
			return false;
		}
		if(count($this->position) != count($this->Detail['OfferNum'])){
			$this->addError('Detail','(OfferNum)非法操作.');
			return false;
		}
		if(count($this->position) != count($this->Detail['ZhaoPin_Place'])){
			$this->addError('Detail','(ZhaoPin_Place)非法操作.');
			return false;
		}
		if(count($this->position) != count($this->Detail['Type'])){
			$this->addError('Detail','(Type)非法操作.');
			return false;
		}
		foreach($this->Detail['Type'] as $item){
			if($item != null){
				if($item != 0 && $item != 1 && $item != 2){
					$this->addError('Detail','(Type)的值不合法.');
					return false;
				}
			}
		}
		return true;
	}

	public function save(){
		$company = Company::model()->find('UserId=:Id',array(':Id'=>Yii::app()->user->UserId));
		$model = new Workinfo;
		$model->CompanyId = $company->Id;
		$model->Verify = 1;
		$model->attributes = $this->attributes;
		$model->save();
		$i = 0;
		$arr = array();
		foreach($this->Detail['Checked'] as $item){
			if($item){
				$detail = new WorkinfoDetail;
				$detail->WorkinfoId = $model->Id;
				$detail->WorkName = $this->position[$i]->WorkName;
				if($this->Detail['OfferNum'][$i] == null){
					$this->addError('Detail','(招聘人数)不能为空.');
					$model->delete();
					foreach($arr as $a){
						$a->delete();
					}
					return false;
				}
				$detail->OfferNum = $this->Detail['OfferNum'][$i];
				$detail->Edu = $this->position[$i]->Edu;
				$detail->Experience = $this->position[$i]->Experience;
				$detail->Sex = $this->position[$i]->Sex;
				$detail->Age = $this->position[$i]->Age;
				if($this->Detail['ZhaoPin_Place'][$i] == null){
					$this->addError('Detail','(招聘城市)不能为空.');
					$model->delete();
					foreach($arr as $a){
						$a->delete();
					}
					return false;
				}
				$detail->ZhaoPin_Place = $this->Detail['ZhaoPin_Place'][$i];
				$detail->WorkPlace = $this->position[$i]->WorkPlace;
				$detail->Pay = $this->position[$i]->Pay;
				if($this->Detail['Type'][$i] == null){
					$this->addError('Detail','(工作类型)不能为空.');
					$model->delete();
					foreach($arr as $a){
						$a->delete();
					}
					return false;
				}
				$detail->Type = $this->Detail['Type'][$i];
				$detail->Introduction = $this->position[$i]->Introduction;
				$detail->Con = $this->position[$i]->Con;
				$detail->Welfare = $this->position[$i]->Welfare;
				$detail->PostTime = date('Y-m-d H:i:s');
				if(!$detail->save()){
					$this->addError('Detail',$detail->getError('WorkinfoId').$detail->getError('WorkName').$detail->getError('OfferNum').$detail->getError('Edu').$detail->getError('Experience').$detail->getError('Sex').$detail->getError('Age').$detail->getError('ZhaoPin_Place').$detail->getError('WorkPlace').$detail->getError('Pay').$detail->getError('Type').$detail->getError('Introduction').$detail->getError('Con').$detail->getError('Welfare').$detail->getError('PostTime'));
					return false;
				}
				array_push($arr,$detail);
			}
			$i++;
		}
		return true;
	}
}
