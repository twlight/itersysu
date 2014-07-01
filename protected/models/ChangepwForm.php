<?php
class ChangepwForm extends CFormModel
{
	public $old_password;
	public $new_password;
	public $password_repeat;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('old_password, new_password, password_repeat', 'required'),
			array('new_password','length','min'=>8,'max'=>20),
			array('password_repeat','compare','compareAttribute'=>'new_password','message'=>'两次输入的密码不一致！'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'old_password'=>'旧密码',
			'new_password'=>'新密码',
			'password_repeat'=>'重复新密码',
		);
	}

	public function change(){
		$user = User::model()->findByPk(Yii::app()->user->UserId);
		if(empty($user)){
			return false;
		}
		if(md5($this->old_password) != $user->Password){
			$this->addError('old_password','旧密码错误！');
			return false;
		}
		if($this->new_password != $this->password_repeat){
			$this->addError('password_repeat','两次输入的密码不一致！');
			return false;
		}
		$user->Password = md5($this->new_password);
		$user->save();
		return true;
	}
}
