<?php 

	/**================= Users ================
	 * This is the class that holds all database *functionalities for the employee
	 * @package: Joe Digital Academy
	 * @Developer: Ebune Joseph
	 */
	 include 'Database.php';
	class Users extends Database
	{
		public $isValidUser;
		public $userId;
		public $name;
		public $username;
		public $password;
		public $email;
		public $role;
		public $matricule;
		public $department;
		public $address;
		public $phoneNumber;
		
		function __construct()
		{
			parent::__construct();
		}
		public function registerUser($data)
		{
			$result = $this->connect->query($data);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}
		public function executeQuery($data)
		{
			$result = $this->connect->query($data);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}

		public function getData($query)
		{
			$data = array();
			$result = $this->connect->query($query);
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}
		public function getUserRole($userId)
		{
			$sql = "SELECT role FROM users WHERE id='$userId'";
			$query = $this->connect->query($sql);
			if (!empty($query)) {
				return $query;
			}
		}

		public function userExist($email, $username, $matricule)
		{
			$sql = "SELECT * FROM users WHERE (email='$email' OR username='$username') OR matricule='$matricule'";
			$result = $this->connect->query($sql);
			$num_rows = $result->num_rows;
			if ($num_rows > 0) {
				return true;
			}else{
				return false;
			}
		}
		public function isAuthenticated($username, $password)
		{
			$sql = "SELECT * FROM users WHERE password='$password' AND username='$username'";
			$result = $this->connect->query($sql);
			$num_rows = $result->num_rows;
			if ($num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$this->userId = $row['id'];
					$this->name = $row['fullname'];
					$this->username = $row['username'];
					$this->password = $row['password'];
					$this->email = $row['email'];
					$this->role = $row['role'];
					$this->matricule = $row['matricule'];
					$this->department = $row['department'];
					$this->address = $row['address'];
					$this->phoneNumber = $row['number'];
					// setting the user to a valid user
					$this->isValidUser = "1";
				}
				// return true;
			}else{
				$this->userId = 0;
				$this->name = "";
				$this->username = "";
				$this->password = "";
				$this->email = "";
				$this->role = "";
				$this->matricule = "";
				$this->department = "";
				$this->address = "";
				$this->phoneNumber = "";
				// setting the user to an invalid user
					$this->isValidUser = "0";
				// return false;
			}
		}

		public function saniticeData($data)
		{
			return mysqli_real_escape_string($this->connect,$data);
		}
		
		public function countNum($table)
		{
			$sql = "SELECT * FROM $table";
			$result = $this->connect->query($sql);
			$rows = $result->num_rows;
			return $rows;
		}

	}// class ends here

 ?>