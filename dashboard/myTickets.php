<?php 
//including the header files
include 'includes/header.php';?>
<?php include 'config/productInstance.php'; ?>
<br><br>

<?php 
$sessID = $_SESSION['id'];
  $sql = "SELECT * FROM tickets where receiver='$sessID'";
  $result = $product->getProducts($sql);

 ?>

 
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href=index.php>Dashboard</a>
          </li>
          <li class="breadcrumb-item active">My Opened Tickets</li>
        </ol>

<div class="card mb-3 ml-3 mr-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            My Opened Tickets</div>
          <div class="card-body">
            <!-- Deletiing user's record from the database -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Material Name</th>
                    <th>Catgory</th>
                    <th>Reason</th>
                    <th>Quantity</th>
                    <th>Stock Keeper</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Material Name</th>
                    <th>Category</th>
                    <th>Reason</th>
                    <th>Quantity</th>
                    <th>Stock Keeper</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <?php if (isset($result)): ?>
                  <?php foreach ($result as $myticket): ?>
                    <tr>
                      <td><?php echo $myticket['material_name']; ?></td>
                      <td><?php echo $myticket['category']; ?></td>
                      <td><?php echo $myticket['reason']; ?></td>
                      <td><?php echo $myticket['quantity']; ?></td>
                      <td>
                      	<?php 
		                    $id = $myticket['stock_keeper'];
		                    $empSql = "SELECT fullname FROM users WHERE id='$id'"; 
		                    $empResult = $product->getProducts($empSql);
		                    	foreach ($empResult as $empData) {
		                    		$stock_keeper = $empData['fullname'];
		                    	}
		                    	?>
		                    <?php echo $stock_keeper; ?>
                      </td>
                      <td><?php echo $myticket['date']; ?></td>
                      <td>
                      	<?php if ($myticket['validated'] == 0): ?>
		                    <button class="btn btn-danger">Not Validated</button>
		                <?php else: ?>
		                    <button class="btn btn-success">Ticket Validated</button>
		                <?php endif ?>
                      </td>
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