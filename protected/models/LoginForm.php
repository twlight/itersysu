<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('email, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			array('email','email'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Email',
			'password'=>'密码',
			'rememberMe'=>'自动登录',
		);
	}

	/**
	 * Logs in the user using the given email and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		$user = User::model()->find('Email=:Email',array(':Email'=>$this->email));
		if(empty($user)){
			$this->addError('password','用户名或密码错误.');
			return false;
		}
		if($user->Password != md5($this->password)){
			$this->addError('password','用户名或密码错误.');
			return false;
		}
		$this->_identity=new UserIdentity($this->email,$this->password);
		$duration=$this->rememberMe ? 3600*24*7 : 0; // 7 days
		Yii::app()->user->login($this->_identity,$duration);
		Yii::app()->user->setState('UserId',$user->Id);
		Yii::app()->user->setState('Email',$user->Email);
		Yii::app()->user->setState('Username',$user->Username);
		Yii::app()->user->setState('UserType',$user->UserType);

		//Add System Logs
		$log = new SysLog;
		$log->UserId = $user->Id;
		$log->Type = 0;
		$log->Ip = getenv("REMOTE_ADDR");
		$log->Time = date('Y-m-d H:i:s');
		$log->save();
		return true;
	}
}
