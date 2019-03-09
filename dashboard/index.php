<?php include 'includes/header.php'; ?>
<?php include 'config/userInstance.php'; ?>
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><?php echo $user->countNum("users"); ?> Employees</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="viewEmployees.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <?php if ($_SESSION['role'] == "stock keeper"): ?>
            
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?php echo $user->countNum("tickets"); ?> Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href=tickets.php>
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php echo $user->countNum("products"); ?> Products!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="products">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><?php echo $user->countNum("tickets WHERE validated=true"); ?> Validated Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <?php endif ?>
        </div>

        <!-- Area Chart Example-->
        <!-- show chart only for stock keepers -->
        <?php if ($_SESSION['role'] == "stock keeper"): ?>
          
        
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Chart Showing Trasaction in terms of stock</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <?php endif ?>

        <!-- DataTables Example -->
        <?php 
          $empSql = "SELECT * FROM users WHERE role='employee'";
          $result = $user->getData($empSql);

         ?>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Registered Employees in the system</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Matricule</th>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Matricule</th>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Email</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($result as $employee): ?>
                    <tr>
                    <td><?php echo $employee['fullname']; ?></td>
                    <td><?php echo $employee['department']; ?></td>
                    <td><?php echo $employee['matricule']; ?></td>
                    <td><?php echo $employee['address']; ?></td>
                    <td><?php echo $employee['number']; ?></td>
                    <td><?php echo $employee['email']; ?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

      
   
   <!-- including the footer content -->
   <?php include 'includes/footer.php'; ?>