<?php
#db connection
class dbConnect
{
	private string $username = "SATDB";
	private string $host = "localhost";
	private string $database = "sat";
	private string $password = "9ks937Lnq4:w2C_";
	protected mysqli|null|false $connection;

	public function __construct() {
		if (!isset($this->connection)) {
			$this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

			if (!$this->connection) {
				echo 'Cannot connect to database server';
				exit;
			}
		}
		return $this->connection;
	}
}
$db = new dbConnect();
// var_dump($db);