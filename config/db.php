<?php

class db {
	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'cbt';

	public function connect()
	{
		$this->conn = null;
		$dsn = 'mysql:host='. $this->dbhost .';dbname='. $this->dbname . ';charset=utf8';
			
		$this->conn = new PDO($dsn, $this->dbuser,$this->dbpass);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			return $this->conn;	
		} catch (PDOException $e) {
			die("Connection failed" . $e->getMessage());
		}
	}
}

?>