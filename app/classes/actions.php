<?php

trait actions
{
	private function account_exists($email)
	{
		$sql = "SELECT * FROM users WHERE Email = '$email'";
		$query = $this->connection->query($sql);
		if ($query->num_rows > 0) {
            $row = $query->fetch_array();
			return $row;
		}
        else {
            return false;
        }
	}
    
	private function register_user()
	{
		$sql = "INSERT INTO users (email, first_name, last_name, creation_date, password) VALUES (
			'$this->sanitized_email','$this->sanitized_first_name','$this->sanitized_last_name',now(),'$this->password_hash')";
		$this->connection->query($sql);

	}
    private function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}

}