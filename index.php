<?php include 'includes/header.php'; ?>
<div id="wrapper">
	<div class="container">
		<form method="post" action="controller/login.php">
			<div class="row" style="margin-top: 100px">
				<div class="col-xl-6 col-sm-6 col-md-6 col-xs-6 offset-3" style="border: 1px solid #ccc; box-shadow: 9px 10px 23px #000; border-radius: 10px"><br>
				<h2 class="text-center text-danger">Stock Management System</h2><hr><br>

				<?php if (isset($_GET['success']) && ($_GET['success'] == "false")): ?>
					<div class="danger bg-danger" style="padding: 10px; color: #fff;">Username and Password not correct</div>
				<?php endif ?>
				<!-- Diplay error if a user tries to get access to the page without having an account -->
				<?php if (isset($_GET['invalid'])): ?>
					<div class="danger bg-danger" style="padding: 10px; color: #fff;"><?php echo $_GET['invalid']; ?></div>
				<?php endif ?>
				<!-- display message when a user logout -->
				<?php if (isset($_GET['logout'])): ?>
					<div class="danger bg-success" style="padding: 10px; color: #fff;">Logout Success. Session Expired</div>
				<?php endif ?>

					<div class="form-group">
						<lable class="label-control">Username</lable>
						<input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
					</div>
					<div class="form-group">
						<lable class="label-control" for="Password">Password</lable>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
					</div>
					<div class="form-group">
						<span>Remember Passwors? &nbsp;<input type="checkbox" name="password" id="password"></span>
						
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Login">
					</div>
				</div>
			</div><!-- end of form row -->
		</form>
	</div>
	
	<?php include 'includes/footer.php'; ?>
