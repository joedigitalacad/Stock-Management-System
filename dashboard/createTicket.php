<?php include 'includes/header.php'; ?>
<?php include 'config/userInstance.php'; ?>
<?php 
  $sql = "SELECT fullname FROM users where role='employee'";
  $names = $user->getData($sql);
  // print_r($result);


 ?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Create Ticket</li>
        </ol>

<div class="container">
    <div class="card mx-auto mt-2">
      <div class="card-header bg-primary" style="color: #fff;">Create Product Tickets fro Employees</div>
      <div class="card-body">
        <form method="post" action="../controller/createTicket.php">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="hidden" id="id" name="id" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
                  <input type="hidden" name="stockKeeperId" value="<?php echo $_SESSION['id'];?>">
                  <input type="text" id="stockKeeper" name="stockKeeper" class="form-control" readonly="readonly" value="<?php echo $_SESSION['name']; ?>" required="required" autofocus="autofocus">
                  <label for="stockKeeper">Stock Keeper</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="reciever" name="reciever" class="form-control">
                    <option>Select name of employee</option>
                    <?php foreach ($names as $name): ?>
                      <option value="<?php echo $name['fullname'];?>"><?php echo $name['fullname'];?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
            </div><!-- // form row -->
          </div>
          <div class="form-row">
	          <div class="col-md-6">
		          <div class="form-group">
		            <div class="form-label-group">
		              <input type="text" id="materialName" name="materialName" class="form-control" readonly="readonly" value="<?php if(isset($_GET['material'])) echo $_GET['material']; ?>" placeholder="Material Name" required="required">
		              <label for="email">Material Name</label>
		            </div>
		          </div>
	          </div>
	          <div class="col-md-6">
		          <div class="form-group">
		            <div class="form-label-group">
		              <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Password" required="required">
		              <label for="quantity">Quantity</label>
		            </div>
                <span id="validated" class="text-danger" style="font-weight: bolder;"></span>
                <span id="true" class="text-success" style="font-weight: bolder;"></span>
		          </div>
	          </div>
      	</div><!-- // form row -->
          <div class="form-group">
            <div class="form-row">
	          <div class="col-md-6">
		          <div class="form-group">
		            <div class="form-label-group">
		              <input type="text" id="category" name="category" class="form-control" value="<?php if(isset($_GET['category'])) echo $_GET['category']; ?>" required="required" readonly="readonly">
		              <label for="category">Category</label>
		            </div>
		          </div>
	          </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <textarea id="reason" name="reason"  required="required" class="form-control" placeholder="Enter reason"></textarea>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" id="submit" name="submit" value="Create Ticket" class="btn btn-primary btn-block">
        </form>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function(){
      $('#quantity').blur(function(){
        var id = $('#id').val();
        // alert(material_name);
        var quantity = $(this).val();
        $.ajax({
          url: "../controller/checkProductQuantity.php",
          method: "POST",
          data: {quantity:quantity, id:id},
          dataType: "text",
          success: function(html){
            if (html != "ok") {
              $('#validated').html(html);
              // $('input[type=submit]').attr("disabled","disabled");
              $('#submit').prop('disabled', true);
              $('#true').html("");
            }else{
              $('#submit').prop('disabled', false);
              $('#validated').html("");
              $('#true').html(html);
            }
            
          }
        });
      });
    });
  </script>

<?php include 'includes/footer.php'; ?>