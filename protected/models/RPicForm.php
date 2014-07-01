<?php

class RPicForm extends CFormModel
{
	public $file;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('file', 'required'),
			array('file','file','types'=>'jpg png'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'file'=>'个人照片',
		);
	}

	public function save($id){
		$main = ResumeMain::model()->findByPk($id);
		if(empty($main)){
			return false;
		}
		$img = Yii::app()->user->Username.'_'.time().'_'.$this->file->getExtensionName();
		$main->Img = $img;
		$main->save();
		$this->file->saveAs(dirname(dirname(dirname(__FILE__))).'/images/resume/'.$img);
		return true;
	}
}
