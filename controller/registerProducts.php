<?php 
include '../dashboard/config/productInstance.php';

	if (isset($_POST['productRegister'])) {
		$productName = $product->saniticeData($_POST['productName']);
		$quantity = $product->saniticeData($_POST['quantity']);
		$category = $product->saniticeData($_POST['category']);
		$mark = $product->saniticeData($_POST['mark']);
		$date = date('Y-m-d h:i:s'); //yy-mm-dd h:i:s
		//echo $date;

		$productDetails = $product->productExist($productName, $mark);
				
		// check if a product has already been registered in the system.
		if (!empty($productDetails) && $productDetails != false){
			foreach ($productDetails as $products) {
				$name = $products['name'];
				$totalQuantity = $products['quantity'];
				$productId = $products['id'];
			}

			$newQuantity = $totalQuantity + $quantity;
			$updateSql = "UPDATE products SET quantity='$newQuantity' WHERE id='$productId'";
			$updateResult = $product->executeQuery($updateSql);
			if ($updateResult) {
				header("location: ../dashboard/products.php?update=true&name=".$name);
			}


		}else{
			$sql = "INSERT INTO products (name, category, mark, date_registered, quantity) VALUES ('$productName', '$category', '$mark', '$date','$quantity')";
			$result = $product->executeQuery($sql);
			if ($result) {
				echo "data has been inserted success";
			}else{
				echo "Data not inserted";
			}
		}
	
	}







 ?>