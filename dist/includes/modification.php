<?php session_start();?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stock Movement | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style>
      
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php 
      include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');

    //  include('../accountant/backend/init.php');

      
    $branch_id = $_SESSION['branch'];
    $staff_id = $_SESSION['id'];
    $bra = $getFromScript->select_branch($branch_id);




      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Modification</li>
            </ol>
            <h1 class="text-center"> Product Modification</h1>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
            
            <div class=" col-xs-6 ">
              <div class="box box-primary">
    
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                <form method="post" action="modification.php" enctype="multipart/form-data">
  
               
                     
                 


                  <div class="form-group">
                    <label for="date">Select Product</label>
                    <div class="input-group col-md-12">
                      <select class="form-control select2" name="prod_id" required>
                      <option >Select Products</option>
				  
            <?php
			 include('../dist/includes/dbcon.php');
				$query2=mysqli_query($con,"select * from product where branch_id='$branch' order by prod_id")or die(mysqli_error());
				  while($row=mysqli_fetch_array($query2)){
		      ?>
            <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?></option>
		      <?php }?>
                    </select>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->



                  <div class="form-group">
						<label for="date">Qty</label>
						<div class="input-group col-md-12">
						  <input type="number" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" required >
						</div><!-- /.input group -->
					  </div><!-- /.form group -->

                  
                      <div class="form-group">
						<label for="date">Reference</label>
						<div class="input-group col-md-12">
						  <textarea  class="form-control pull-right" id="ref" name="ref" placeholder="Reference" required ></textarea>
						</div><!-- /.input group -->
					  </div><!-- /.form group -->

                      <div class="form-group">
						<div class="input-group">
						  <input class="btn btn-info" id="daterange-btn" type="submit" name="submit" value="Submit Modification">
							
						  </input>
						
						</div>
					  </div><!-- /.form group -->
				  </form>	

                 
                </div><!-- /.box-body -->
 
                </div><!-- /.col -->

                </div><!-- /.col -->

         
       <div class="col-xs-6">
			<table id="example1" class="table table-bordered  table-striped table-responsive bg-white text-center">
                    <thead>
                    <tr>
                      <h3 style="color: orange">Recently Modified Items</h3>
                    </tr>
                      <tr>
                        <th>S/N</th>
                        <th>Product</th>
                         <th>Qty</th>
                        <th>Ref</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
	$query=mysqli_query($con,"select * from product_edit_history inner join product on product_edit_history.prod_id = product.prod_id limit 50 ")or die(mysqli_error($con));
              
                $sn = 1;
               // $row = mysqli_fetch_array($query);
              //  var_dump($row);
								while($row = mysqli_fetch_array($query)){
                
                 // $total = $row['qty'] * $row['cost_price'];
								 
?>
            <tr>
            <td><?php echo $sn;?></td>
            <td><?php echo $row['prod_name'];?></td>
           
           
         
           
             <td><?php echo $row['qty'];?></td>
        
<td style="text-align:right"><?php
           
           echo $row['ref'];
        
             ?></td>
            <td><?php echo date("M d, Y h:i a",strtotime($row['date_created']));?></td>    
			
            </tr>
 <?php $sn+=1; }?>                       
                     
		
                    </tbody>
                    
       </table>
       </div>
			
			
          </div><!-- /.row -->

            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>

<?php
    if(isset($_POST['submit'])){
               
        $branch_id = $_SESSION['branch'];
        $staff_id = $_SESSION['id'];
        $prod_id = $_POST['prod_id'];
        $qty = $_POST['qty'];
        $ref = $_POST['ref'];

       
                $update_one = $getFromScript->update_modification($prod_id, $qty);
                if($update_one){
                  $insert_one = $getFromScript->insert_history_modification($prod_id, $qty,$staff_id,$ref);
                  
                    if($insert_one){
                        echo "<script>alert('Modification Successful')</script>";  
                    }

                   
                }
            
      
      
      

       

    }








    



/*


    if(isset($_POST['branchs'])){
               
        $branch = $_SESSION['branch'];
        $store = $_POST['store'];
        $product = $_POST['product'];
        $qty = $_POST['qty'];

      // echo "<script>alert('Stock Movement ". $branch_id."Successful')</script>";       
        $check_prod = $getFromScript->check_store($product, $branch);
        if($check_prod->no_product < $qty){
            echo "<script>alert('Insufficient Stock')</script>";               

        }else{
              
          
                $update_ones = $getFromScript->update_productsec($branch, $product, $qty);
                if($update_ones){
                   // echo "<script>alert('Stock Movement  Successfully')</script>";  
                    $update_twos = $getFromScript->update_storeSec( $store, $branch, $product, $qty);
                   
                    if($update_twos){
                        echo "<script>alert('Stock Movement Successful')</script>";  
                    }

                   
                }
            
         }

       

    }

*/

?>