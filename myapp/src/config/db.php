<?php
    class db{
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = '';
		private $dbname = 'todolist';

        // try to connect database
        public function connect(){
			try {
				$mysql_connect_params = "mysql:host=$this->dbhost;dbname=$this->dbname";
				$dbConnection = new PDO($mysql_connect_params, $this->dbuser, $this->dbpass);
				$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "connection failed" . $e->getMessage();
			}
            return $dbConnection;
        }
    }