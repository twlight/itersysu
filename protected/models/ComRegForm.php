<?php

class ComRegForm extends CFormModel
{
	public $email;
	public $username;
	public $password;
	public $password_repeat;
	public $company_name;
	public $tel;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email, username, password, password_repeat, company_name, tel', 'required'),
			array('email','email'),
			array('email','unique','className'=>'User','attributeName'=>'Email'),
			array('password','length','min'=>8,'max'=>20),
			array('password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致！'),
			array('company_name, tel','length','max'=>255),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Email',
			'username'=>'用户名',
			'password'=>'密码',
			'password_repeat'=>'重复密码',
			'company_name'=>'公司名称',
			'tel'=>'联系电话',
		);
	}

	public function register(){
		$user = new User;
		$user->Email = $this->email;
		$user->Username = $this->username;
		$user->Password = md5($this->password);
		$user->UserType = 1;
		$user->save();
		$company = new Company;
		$company->CompanyName = $this->company_name;
		$company->Tel = $this->tel;
		$company->UserId = $user->Id;
		$company->save();
		return true;
	}
}
