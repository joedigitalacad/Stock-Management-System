<?php 
ob_start();
session_start();

date_default_timezone_set("GMT");
	// Stock keeper and employees will use same logic to login but will be limited
	// based on their roles. these users will have the same dashboard design but
	// some functionalities will be registered for a normal user
	
	// function sessionStart($lifetime, $path, $domain, $secure, $httponlys)
	// {
	// 	session_set_cookie_params($lifetime, $path, $domain, $secure, $httponlys);
	// 	session_start();
	// }

	include '../models/Users.php';
	$user = new Users();

	if (isset($_POST['submit'])) {
		$username = $user->saniticeData(@$_POST['username']);
		$password = $user->saniticeData(@$_POST['password']);
		$encPassword = md5($password);
		$user->isAuthenticated($username, $encPassword);
		if ($user->userId > 0){
			// sessionStart(0, '/', 'localhost', false, true);
			$_SESSION['id'] = $user->userId;
			$_SESSION['name'] = $user->name;
			$_SESSION['role'] = $user->role;
			$_SESSION['valid'] = true;
			// if ($_SESSION['role'] != "stock keeper") {
			// 	header("location:../userDashboard/index.php");
			// }else{
			// 	header("location:../dashboard/index.php");
			//   	exit;
			// }
			header("location:../dashboard/index.php");
			exit;
			  
		}else{
			$_SESSION['valid'] = false;
			setcookie("authentic","0");
			// add an image loader to the page
			  header("Refresh:2; url=http://localhost/ingrid/index.php?success=false");
			  exit;
		}

	}





 ?>