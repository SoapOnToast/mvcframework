<?php
include_once('dbConnect.php');
include_once('validations.php');
include_once('actions.php');

class Login extends dbConnect
{
	use validations;
	use actions;

	private string $sanitized_email;
	private string $password_hash;
	private string $location;
	public string $auth;

	public function __construct($email, $password) {
		parent::__construct();
		$this->location = "index.php";
		$this->check_exists($email);
		$this->check_exists($password);
		$this->validate_email($email);
		$this->sanitized_email = $this->escape_string($email);
		$this->password_hash = md5($password);
		$this->auth = $this->authenticate();
	}

	private function authenticate() {
		$row = $this->account_exists($this->sanitized_email);
		if ($row != false)
		{
			if ($row['password'] == $this->password_hash && $row['email'] == $this->sanitized_email)
			{
				$_SESSION['user']= $row['ID'];
			}
		}
		return false;
	}
}

