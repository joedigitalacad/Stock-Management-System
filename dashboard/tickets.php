<?php include 'includes/header.php'; ?>
<?php include 'config/productInstance.php'; ?>
<?php 
	$sql = "SELECT * FROM users,tickets where (users.id=tickets.stock_keeper)";
	$result = $product->getProducts($sql);
?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tickets</li>
        </ol>

<?php if (isset($_GET['create']) && $_GET['create'] == true): ?>
	<div class="alert alert-success">New Ticket created for <?php echo $_GET['name']; ?></div>
<?php endif ?>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="bg-success" style="color: #fff">Stock Keeper</th>
                    <th class="bg-success" style="color: #fff">Receiver</th>
                    <th>Material Name</th>
                    <th>Category</th>
                    <th>Reason</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Validated</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th class="bg-success" style="color: #fff">Stock Keeper</th>
                    <th class="bg-success" style="color: #fff">Receiver</th>
                    <th>Material Name</th>
                    <th>Category</th>
                    <th>Reason</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Validated</th>
                  </tr>
                </tfoot>
                <tbody>
                	<?php foreach ($result as $ticket): ?>
                		<tr>
		                    <td style="background: #ccc">
		                    	<?php //printStockKeeperName($ticket['stock_keeper']); ?>
		                    	<?php echo $ticket['fullname'] ?> 
		                    	
		                    </td>
		                    <td style="background: #ccc">
		                    	<?php 
		                    	$id = $ticket['receiver'];
		                    	$empSql = "SELECT fullname FROM users WHERE id='$id'"; 
		                    	$empResult = $product->getProducts($empSql);
		                    	foreach ($empResult as $empData) {
		                    		$receiver_name = $empData['fullname'];
		                    	}
		                    	?>
		                    	<?php echo $receiver_name; ?>
		                    </td>
		                    <td><?php echo $ticket['material_name']; ?></td>
		                    <td><?php echo $ticket['category']; ?></td>
		                    <td><?php echo $ticket['reason']; ?></td>
		                    <td><?php echo $ticket['quantity']; ?></td>
		                    <td><?php echo $ticket['date']; ?></td>
		                    <td>
		                    	<?php if ($ticket['validated'] == 0): ?>
		                    		<a href="?id=<?php echo $ticket['id']?>" class="btn btn-danger" onclick="if(!confirm('This ticket is about to be validated')) return false;">Click to Validate</a>
		                    		<?php else: ?>
		                    			<a href="" class="btn btn-success">Ticket Validated</a>
		                    	<?php endif ?>
		                    		
		                    </td>
		                </tr>
                	<?php endforeach ?>
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>


        <!-- script to validate an open ticket -->

        <?php 
        	if (isset($_GET['id'])) {
        		$id = $_GET['id'];
        		$valSql = "UPDATE tickets SET validated=true WHERE id='$id'";
        		$product->executeQuery($valSql);
        		header("Refresh:1;url=http://localhost/ingrid/dashboard/tickets.php");
        		newt_refresh();
        	}

         ?>
<?php include 'includes/footer.php'; ?>