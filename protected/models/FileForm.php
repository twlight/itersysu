<?php

class FileForm extends CFormModel
{
	public $filename;
	public $file;
	public $Username;
	public $Sex;
	public $Edu;
	public $Experience;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('filename, file, Username, Sex, Edu, Experience', 'required'),
			array('filename, Username','length','max'=>255),
			array('file','file','types'=>'doc docx pdf'),
			array('Sex','in','range'=>array(1,2)),
			array('Edu','in','range'=>array(0,1,2,3,4,5,6)),
			array('Experience','in','range'=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13)),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'filename'=>'简历名称',
			'file'=>'上传文件',
			'Username'=>'真实姓名',
			'Sex'=>'性别',
			'Edu'=>'最高学历',
			'Experience'=>'工作经验',
		);
	}

	public function save($id){
		if(empty($id)){
			$file = new ResumeFile;
		}
		else{
			$resume = Resume::model()->findByPk($id);
			$file = ResumeFile::model()->findByPk($resume->ResumeFileId);
		}
		$file->Name = $this->filename;
		$file->Filename = $this->file->getName();
		$file->RealFilename = rand(0,99999).'_'.time().'.'.$this->file->getExtensionName();
		$file->Username = $this->Username;
		$file->Sex = $this->Sex;
		$file->Edu = $this->Edu;
		$file->Experience = $this->Experience;
		$file->save();
		$this->file->saveAs(dirname(dirname(__FILE__)).'/resumes/'.$file->RealFilename);
		if($this->file->getExtensionName() == 'pdf'){
			exec(dirname(dirname(__FILE__)).'/processpdf.py'.' '.$file->Id);
		}
		else{
			putenv('PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin:');
			exec(dirname(dirname(__FILE__)).'/processdoc.py'.' '.$file->Id);
		}
		if(empty($id)){
			$resume = new Resume;
			$resume->UserId = Yii::app()->user->UserId;
			$resume->Type = 2;
			$resume->ResumeFileId = $file->Id;
			$resume->ModifyTime = date('Y-m-d H:i:s');
			$resume->save();
		}
		return true;
	}
}
