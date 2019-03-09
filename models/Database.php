<?php 

	/**================= DATABASE ================
	 * Database connection class
	 * @package: JoeDigitalAcademy
	 * @Developer: Ebune Joseph
	 */
	 class Database
	{
		// this connect variable wuill hold the database connection
		protected $connect;
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $database = "ingrid_project";
		// constructor 
		function __construct()
		{
			$this->connect = new mysqli($this->host, $this->user, $this->pass, $this->database); 
			if (mysqli_connect_errno()) {
				die("Unable to connect to the database");
				exit;
			}
			return $this->connect;
		}

	}






 ?>