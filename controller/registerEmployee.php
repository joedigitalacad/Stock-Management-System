<?php 

// INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `role`, `matricule`, `department`, `address`, `number`, `image`) VALUES (NULL, 'Ebune joseph Achancho', 'ebune', MD5('ebune'), 'ebuneachancho@gmail.com', 'admin', 'STK001', 'IT Department', 'Bonduma Gate, Molyko Buea, Cameroon', '653468306', '');

if (isset($_POST['register'])){
	# get employee information from the database
	include '../models/Users.php';
	$user = new Users();
	$fullname = $user->saniticeData($_POST['fullname']);
	$username = $user->saniticeData($_POST['username']);
	$email = $user->saniticeData($_POST['email']);
	$password = $user->saniticeData($_POST['password']);
	$matricule = $user->saniticeData($_POST['matricule']);
	$department = $user->saniticeData($_POST['department']);
	$role = $user->saniticeData($_POST['role']);
	$address = $user->saniticeData($_POST['address']);
	$number = $user->saniticeData($_POST['number']);
	// enc password
	$password = md5($password);

	# Check in the database if a user has already been created
	if ($user->userExist($email, $username, $matricule)) {
		echo "This user has already been registered into the system";
		// redirect to user registration page with message
	}else{
		$sql = " INSERT INTO users (id, fullname, username, password, email, role, matricule, department, address,number) VALUES (NULL, '$fullname', '$username','$password', '$email', '$role', '$matricule', '$department', '$address', '$number')";
		$result = $user->registerUser($sql);
		if ($result) {
			// send mail to newly created user
			$to = $email;
			$subject = "Account Info on Ingrid Stock System";
			$message = '<div style="width: 90%; padding: 10px; background: #fff;">'. '<h1>Account successfully created on our system.</h1><p>Below are your information and login credentials. make sure you change your password once logged in</p>' .'Username: '. $username. 'Password'. $password
			. '</div>';
			
			mail($to, $subject, $message);
				header("location: ../dashboard/registerEmployee.php?success=true");

		}

	}
	# save the employee to the database
	# send the registered employee an email telling him/her that they have been register
	# also send the stock keeper the newly registered user details
}

 ?>