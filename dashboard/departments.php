<?php include 'includes/header.php'; ?>
<?php include '../models/Users.php'; ?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Departments</li>
        </ol>

<!-- register the department in the database -->
<?php 
  $user = new Users();
	if (isset($_POST['register'])) {
		$department = $user->saniticeData($_POST['department']);
		$description = $user->saniticeData($_POST['description']);
		$sql = "INSERT INTO departments(name, description) VALUES ('$department', '$description')";
		$result = $user->executeQuery($sql);
		if ($result) {
			echo '<div class="bg-success p-3 mb-3" style="color: #fff;">Department Registered successfully</div>';
		}
	}
	
 ?>

 <!-- Getting registered departments from the database -->
 <?php 
 $sql = "SELECT * FROM departments";
 $queryResult = $user->getData($sql);
  ?>

 <?php 
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM departments WHERE id='$id'";
    $deleteResult = $user->executeQuery($sql);
    if ($deleteResult) {
      echo '<p class="mb-3" style="padding: 10px; background: green; color: #fff; width; 50%; margin: auto;">' . 'Department has been succesfully deleted from the database' . '</p>';
      header("Refresh:3;url=http://localhost/ingrid/dashboard/departments.php");
    }
  }

  ?>
<div class="row">
          <div class="col-lg-8">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-bar"></i>
                Register Departments in the Organisation</div>
              <div class="card-body">
              	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              		<div class="form-group">
			            <div class="form-row">
			              <div class="col-md-6">
			                <div class="form-label-group">
			                  <input type="text" id="department" name="department" class="form-control" placeholder="Name id department" required="required" autofocus="autofocus">
			                  <label for="department">Name of Department</label>
			                </div>
			              </div>
			              <div class="col-md-6">
			                <div class="form-label-group">
			                	<textarea class="form-control" name="description" placeholder="Enter the description of the department" ></textarea>
			                </div>
			              </div>
			            </div><!-- // form row --><br>
			            <input type="submit" class="btn btn-success btn-block" name="register">
			          </div>
              	</form>
              </div>
              <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-pie"></i>
                Registered Departments</div>
              <div class="card-body">
                <?php if (isset($queryResult) || !empty($queryResult)): ?>
                	<div class="table col-xs-12">
                		<table class="table-striped col-xs-12">
                			<thead><th>Name</th><th>Action</th></thead>
                	<?php foreach ($queryResult as $department): ?>
                		<td class="col-xs-12"><?php echo $department['name']; ?></td>
                		<td><a href="?id=<?php echo $department['id'];?>" class="btn btn-danger" onclick="if (!confirm('Are you sure you want to delete this Department?')) {return false}">Delete</a></td>
                	<?php endforeach ?>
                	</table>
                	</div>
                <?php endif ?>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>
        </div>


<?php include 'includes/footer.php'; ?>