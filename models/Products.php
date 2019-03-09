<?php 
	/**
	 * Product Class: Here we are going to write logic to get all products, save *products and update pproducts to the database. the product logic will be added *here. 
	 * @Package: Joe Digital Academy
	 * @Github: github.com/joe-digital-academy
	 * @Source: www.joe-digital-academy.com
     * License: GNU Open source
	 */
	include 'Database.php';
	class Products extends Database
	{
		
		function __construct()
		{
			parent::__construct();
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
		public function getProducts($sql)
		{
			$data = array();
			$result = $this->connect->query($sql);
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;	
		}
		public function getProductCategory($sql)
		{
			$data = array();
			$result = $this->connect->query($sql);
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;	
		}
		public function productExist($name, $mark)
		{
			$sql = "SELECT * FROM products WHERE name='$name' AND mark='$mark'";
			$result = $this->connect->query($sql);
			$num_rows = $result->num_rows;
			// echo $num_rows;
			$data = array();
			if ($num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
					return $data;
				}
			}else{
				return false;
			}
		}
		public function createTicket($data)
		{
			$result = $this->connect->query($data);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}
		
		// skip this when creating the tutorial. you will come back and 
		// create it as the tutorial continues
		public function getReceiversId($name)
		{
			$sql = "SELECT id from users WHERE fullname='$name'";
			$result = $this->connect->query($sql);
			while ($data = $result->fetch_array()) {
				$id = $data['id'];
			}
			return $id;
		}
		// this will be implemeted when you are creating tickets. skip this in tuts
		public function updateProductQuantity($id, $quantity)
		{
			$sql = "UPDATE products SET quantity='$quantity' WHERE id='$id'";
			$result = $this->connect->query($sql);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}

		public function saniticeData($data)
		{
			return mysqli_real_escape_string($this->connect,$data);
		}
	}





 ?>