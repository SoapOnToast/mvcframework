<?php

trait validations {
    
	private function check_exists($var)
	{
		if ($var=='' or $var==null)
		{
		    $_SESSION['message'] = "<p class='error'>Please enter all fields.</p>";
            header("Location: {$this->location}");
            exit();
		}
		else
		{
			return true;
		}
	}


    private function validate_email($input)
    {
        if(filter_var($input,FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        $_SESSION['message'] = "<p class='error'>Invalid email address.</p>";
        header("Location: {$this->location}");
        exit();
        
    }

    private function validate_name($input, $name)
    {
        $rule = "/^[a-z ,.'-]+$/i";
        if (preg_match($rule,$input))
        {
            return true;
        }
        $_SESSION['message'] = "<p class='error'>Invalid {$name}.</p>";
        header("Location: {$this->location}");
        exit();
    }


	private function verify_password($password,$passwordAgain)
	{
		if ($password != $passwordAgain)
		{
			$_SESSION['message'] ='<p class="error">Password does not match</p>';
            header("Location: {$this->location}");
            exit();
		}
	}

}