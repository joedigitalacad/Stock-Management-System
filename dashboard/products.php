<?php include 'includes/header.php'; ?>
<?php include 'config/productInstance.php'; ?>

<?php 
  $sql = "SELECT * FROM products";
  $result = $product->getProducts($sql);
  // print_r($result);

 ?>
 <!-- Getting products from the database that are getting finish -->
 <?php 
 	$qSql = "SELECT * FROM products WHERE quantity<5";
 	$resultQuantity = $product->getProducts($qSql);
 	// print_r($resultQuantity);
  ?>

	<?php 
	    if (isset($_POST['addQuantity'])) {
      	$id = $_POST['id'];
      	$quantity = $_POST['quantity'];
      	$preQuantity = $product->getProducts("SELECT quantity FROM products WHERE id='$id'");

      	foreach ($preQuantity as $keyquantity) {
      		$newQuantity = $keyquantity['quantity'] + $quantity;
      	}

      	$addSql = "UPDATE products SET quantity='$newQuantity'";
      	$qresult = $product->executeQuery($addSql);
      }


		      ?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Products</li>
        </ol>

	<div class="card mb-3 ml-3 mr-3 mt-4">
		<?php if ((isset($_GET['update']) && $_GET['update'] == true) || (isset($_GET['name']) && !empty($_GET['name']))): ?>
        <div class="bg-success p-1 mb-3">
          <p style="color: #fff">New Quantity has been added to <?php echo $_GET['name']; ?></p>
        </div>
      <?php endif ?>

      <!-- Printing notification messages to products that are almost finish in stock -->
      <?php if (!empty($resultQuantity)): ?>
      	<?php foreach ($resultQuantity as $lowQuantity): ?>
      		<!-- if greater than 0 say soon -->
      		<?php if ($lowQuantity['quantity'] > 0): ?>

      		<div class="alert alert-danger"><?php echo $lowQuantity['name']; ?> is getting finish in stock. Order new stock for this product</div>
      		<?php endif ?>

      		<?php if ($lowQuantity['quantity'] == 0): ?>
      			<div class="alert alert-danger">
      				<?php echo $lowQuantity['name'] ?> is finished in stock
      			</div>
      		<?php endif ?>
      	<?php endforeach ?>
      <?php endif ?>
          <div class="card-header">
            <i class="fas fa-table"></i> &nbsp; &nbsp; All Products in Stock
            <button class="btn btn-primary" data-toggle="modal" data-target="#productModal" style="float: right;">Add New Product</button>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Mark</th>
                    <th>Quantity</th>
                    <th>Date Registered</th>
                    <th>Action</th>
                    <th>Ticket Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Name</th>
                    <th>Category</th>
                    <th>Mark</th>
                    <th>Quantity</th>
                    <th>Date Registered</th>
                    <th>Action</th>
                    <th>Ticket Action</th>
                  </tr>
                </tfoot>
                <tbody>
                	<?php foreach ($result as $allProducts): ?>
                		<tr>
                			<td><?php echo $allProducts['name']; ?></td>
                			<td><?php echo $allProducts['category']; ?></td>
                			<td><?php echo $allProducts['mark']; ?></td>
                			<td>
                				<?php if ($allProducts['quantity'] > 5){
                				echo '<p class="text-success">' . $allProducts['quantity'] . '</p>';
                				}else{
                					echo '<p class="text-danger">' . $allProducts['quantity'] . '</p>';
                				} ?>
                				
                			</td>

                			<td><?php echo $allProducts['date_registered']; ?></td>
                			<td><a class="btn btn-success" href="?id=<?php echo $allProducts['id']; ?>" data-toggle="modal" data-target="#quantityModal">Add Quantity</a></td>
                			<td><a class="btn btn-primary" href="createTicket.php?id=<?php echo $allProducts['id'];?>&material=<?php echo $allProducts['name'];?>&category=<?php echo $allProducts['category'];?>">Create Ticket</a></td>
                		</tr>
                	<?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

<!-- Add Quantity Modal -->
<div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog" role="document">
		     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		      <div class="modal-content">
		        <div class="modal-header">
		          <h5 class="modal-title" id="exampleModalLabel">Add a new Quantity to this product?</h5>
		          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">×</span>
		          </button>
		        </div>
		        <div class="modal-body">
		        	<!-- form content -->
		        		<div class="form-group">
				            <div class="form-row">
				              <div class="col-md-10">
				                <div class="form-label-group">
				                	<input type="hidden" name="id" value="<?php echo $allProducts['id'];?>">
				                  <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Product Name" required="required" autofocus="autofocus">
				                  <label for="quantity">Product Quantity</label>
				                </div>
				              </div>
				            </div><!-- // form row -->
				          </div>
		        	<!-- End form -->
		        </div>
		        <div class="modal-footer">
		          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		          <input type="submit" value="Add Quantity" name="addQuantity" class="btn btn-primary">
		        </div>
		      </div><!--//modal content -->
		  </form>
		    </div>




        <!-- Add Products Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog" role="document">
		     <form method="post" action="../controller/registerProducts.php">
		      <div class="modal-content">
		        <div class="modal-header">
		          <h5 class="modal-title" id="exampleModalLabel">Add a new Product?</h5>
		          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">×</span>
		          </button>
		        </div>
		        <div class="modal-body">Fill in the form to register a new stock in the system <br><br>
		        	<!-- form content -->
		        		<div class="form-group">
				            <div class="form-row">
				              <div class="col-md-6">
				                <div class="form-label-group">
				                  <input type="text" id="productName" name="productName" class="form-control" placeholder="Product Name" required="required" autofocus="autofocus">
				                  <label for="productName">Product Name</label>
				                </div>
				              </div>
				              <div class="col-md-6">
				                <div class="form-label-group">
				                  <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Last name" required="required">
				                  <label for="quantity">Quantity</label>
				                </div>
				              </div>
				            </div><!-- // form row -->
				          </div>
		        		<div class="form-group">
				            <div class="form-row">
				              <div class="col-md-6">
				                <div class="form-label-group">
				                	<?php 
				                	$sql = "SELECT * FROM categories";
				                	$categoryResult = $product->getProductCategory($sql);
				                	 ?>
				                  <select name="category" id="category" class="form-control" required="required">
				                  	<option>Select category</option>
				                  	<?php foreach ($categoryResult as $category): ?>
				                  		<option value="<?php echo $category['name']?>"><?php echo $category['name']?></option>	
				                  	<?php endforeach ?>
				                  </select>
				                </div>
				              </div>
				              <div class="col-md-6">
				                <div class="form-label-group">
				                  <input type="text" id="mark" name="mark" class="form-control" placeholder="Enter the mark of the product" required="required">
				                  <label for="mark">Product Mark</label>
				                </div>
				              </div>
				            </div><!-- // form row -->
				          </div>
		        	</form>
		        	<!-- End form -->
		        </div>
		        <div class="modal-footer">
		          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		          <input type="submit" value="Register Product" name="productRegister" class="btn btn-primary">
		        </div>
		      </div><!--//modal content -->
		  </form>
		    </div>
  </div>
        <!-- End Add Products Modal -->

<?php include 'includes/footer.php'; ?>