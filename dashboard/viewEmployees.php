<?php 
//including the header files
include 'includes/header.php';?>
<?php include '../models/Users.php'; ?>
<br><br>
<?php 

  $users = new Users();
  $sql = "SELECT * FROM users where role='employee'";
  $result = $users->getData($sql);

 ?>

 
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href=index.php>Dashboard</a>
          </li>
          <li class="breadcrumb-item active">View Employees</li>
        </ol>

<div class="card mb-3 ml-3 mr-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <!-- Deletiing user's record from the database -->
  <?php 
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id='$id'";
    $deleteResult = $users->executeQuery($sql);
    if ($deleteResult) {
      echo '<p class="mb-3" style="padding: 10px; background: green; color: #fff; width; 50%; margin: auto;">' . 'Data has been succesfully deleted from the database' . '</p>';
    }
  }

  ?>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Matricule</th>
                    <th>Role</th>
                    <th>Number</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Matricule</th>
                    <th>Role</th>
                    <th>Number</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
                <?php if (isset($result)): ?>
                  <?php foreach ($result as $user): ?>
                    <tr>
                      <td><?php echo $user['fullname']; ?></td>
                      <td><?php echo $user['email']; ?></td>
                      <td><?php echo $user['department']; ?></td>
                      <td><?php echo $user['matricule']; ?></td>
                      <td><?php echo $user['role']; ?></td>
                      <td><?php echo $user['number']; ?></td>
                      <td>
                      <a href="?delete=<?php echo $user['id'];?>" class="btn btn-success">View</a>
                      <a href="?id=<?php echo $user['id'];?>" onclick="if (!confirm('Are you sure you want to delete this employee data?')) return false" class="btn btn-danger">Delete</a></td>
                    </tr>
                  <?php endforeach ?>
                  
                <?php endif ?>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>


<?php include 'includes/footer.php'; ?>