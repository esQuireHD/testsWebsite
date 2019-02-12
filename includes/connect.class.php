<?php

	class Connect {
		private $host;
		private $username;
		private $password;
		private $db;
		
		//funkcija, kas piekonektējas datubāzei
		public function connect() {
			$this->host = 'localhost';
			$this->username = 'root';
			$this->password = '';
			$this->db = 'tests_database';
			
			$conn = new mysqli($this->host, $this->username, $this->password, $this->db);
			mysqli_set_charset($conn, 'utf8');
			return $conn;
		}
	}

?>