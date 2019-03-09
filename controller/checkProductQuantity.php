<?php include '../dashboard/config/productInstance.php';

if (isset($_POST['quantity'])  || isset($_POST['id'])) {
	$quantity = $_POST['quantity'];
	$id = $_POST['id'];
	// echo $materialName;

	// get current quantity from the database
	$sql = "SELECT quantity from products WHERE id='$id'";
	$result = $product->getProducts($sql);
	// print_r($result);
	foreach ($result as $newquantity) {
		$currentQuantity = $newquantity['quantity'];
	}
	// echo $currentQuantity;
	if ($quantity <= $currentQuantity){
		echo "ok";
	}else{
		echo "Only " . $currentQuantity . " left in stock";
		return false;
	}
	// check quantity in the database if is ok

}




 ?>