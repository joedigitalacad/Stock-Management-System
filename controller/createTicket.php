<?php 
	// this script will create tickets for user. this functionality is ver important
include '../dashboard/config/productInstance.php';

if (isset($_POST['submit'])) {
	$stockKeeper = $product->saniticeData($_POST['stockKeeper']);
	$stockKeeperId = $product->saniticeData($_POST['stockKeeperId']);
	$receiver = $product->saniticeData($_POST['reciever']);
	$materialName = $product->saniticeData($_POST['materialName']);
	$quantity = $product->saniticeData($_POST['quantity']);
	$category = $product->saniticeData($_POST['category']);
	$reason = $product->saniticeData($_POST['reason']);
	$id = $_POST['id'];
	$date = date("Y-m-d h:i:s");
	$validated = false;

	// reduce the quantity from the quantity of the product
	$qsql = "SELECT quantity FROM products WHERE name='$materialName'";
	$qresult = $product->getProducts($qsql);
	// print_r($qresult);

	foreach ($qresult as $newProduct) {
		$currentQuantity = $newProduct['quantity'];
	}
	// reduce the quantity
	$updateQuantity = $currentQuantity - $quantity;
	
	// update the quantity
	if ($product->updateProductQuantity($id, $updateQuantity)) {
		// get receiver's id from the database
		$receiverId = $product->getReceiversId($receiver);

		$sql = " INSERT INTO tickets (id, material_name, date, reason, category, quantity, stock_keeper, receiver, validated) VALUES (NULL, '$materialName', '$date','$reason', '$category', '$quantity', '$stockKeeperId', '$receiverId', '$validated')";

		$result = $product->createTicket($sql);
		if ($result) {
			// redirect to the ticket validation page
			header("location: ../dashboard/tickets.php?create=true&name=" . $receiver);
		}
	}
	
	
}





 ?>