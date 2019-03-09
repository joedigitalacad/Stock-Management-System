<?php 
//including the header files
include 'includes/header.php';?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Register Products</li>
        </ol>

<div class="container">
    <div class="card mx-auto mt-2">
      <div class="card-header bg-primary" style="color: #fff;">Add an Employee to the System</div>
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full names" required="required" autofocus="autofocus">
                  <label for="fullname">Full Names</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="username" id="username" class="form-control" placeholder="Last name" required="required">
                  <label for="username">Username</label>
                </div>
              </div>
            </div><!-- // form row -->
          </div>
          <div class="form-row">
	          <div class="col-md-6">
		          <div class="form-group">
		            <div class="form-label-group">
		              <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="required">
		              <label for="email">Email address</label>
		            </div>
		          </div>
	          </div>
	          <div class="col-md-6">
		          <div class="form-group">
		            <div class="form-label-group">
		              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
		              <label for="password">Password</label>
		            </div>
		          </div>
	          </div>
      	</div><!-- // form row -->
          <div class="form-group">
            <div class="form-row">
	          <div class="col-md-6">
		          <div class="form-group">
		            <div class="form-label-group">
		              <input type="text" id="matricule" name="matricule" class="form-control" placeholder="Matricule" required="required">
		              <label for="matricule">Matricule</label>
		            </div>
		          </div>
	          </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="department" name="department" class="form-control" placeholder="Confirm password" required="required">
                  <label for="department">Department</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <select class="form-control" name="role">
                  	<option>Choose a role for this user</option>
                  	<option value="stock keep">Stock Keeper</option>
                  	<option value="employee">Employee</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="address" name="address" class="form-control" placeholder="Address" required="required">
                  <label for="address">Address</label>
                </div>
              </div>
            </div><!-- form row-->
            <div class="form-group">
            	<div class="form-row">
	            	<div class="col-md-6">
		                <div class="form-label-group">
		                  <input type="text" id="number" name="number" class="form-control" placeholder="Phone Number" required="required">
		                  <label for="number">Phone Number: e.g +237 666666666</label>
		                </div>
		              </div>
          		</div>
            </div>
              
          </div>
          <a class="btn btn-primary btn-block" href="login.html">Register</a>
        </form>
      </div>
    </div>
  </div>




<?php include 'includes/footer.php'; ?>