<?php
#LOGIN FILE
include_once('dbConnect.php');
include_once('validations.php');
include_once('actions.php');

class user extends dbConnect
{
	use validations;
	use actions;

	private string $sanitized_first_name;
	private string $sanitized_last_name;
	private string $sanitized_email;
	private string $password_hash;

	private string $location;


	public function __construct($first_name,$last_name,$email,$password,$passwordAgain)
	{
		parent::__construct();
		$this->location = "signup.php";

		array_map([$this, 'check_exists'],[$first_name,$last_name,$email,$password,$passwordAgain]);

		array_map([$this, 'validate_name'],[$first_name, $last_name],["first name", "last name"]);

		$this->validate_email($email);

		$this->verify_password($password,$passwordAgain);
		
		$this->sanitized_first_name = $this->escape_string($first_name);
		$this->sanitized_last_name = $this->escape_string($last_name);
		$this->sanitized_email = $this->escape_string($email);
		$this->password_hash = md5($password);

		if ($this->account_exists($this->sanitized_email) != false)
		{
			$_SESSION['message'] ='<p class="error">This email address is already in use.</p>';
			header('Location: signup.php');
			exit();
		}
		$this->register_user();
	}

}
