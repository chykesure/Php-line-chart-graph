<?php
//session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
date_default_timezone_set("Africa/Lagos"); 
?>
<?php
include('../dist/includes/dbcon.php');

if(!isset($_SESSION['super_admin_id'])){
  if(!isset($_SESSION['acct_id'])){
    if(!isset($_SESSION['admin_id'])){
      
      if(!isset($_SESSION['sales_id'])){
        if(!isset($_SESSION['checkers_id'])){
          echo "<script type='text/javascript'>alert('you are not  qualified to access this page!');</script>";
          echo "<script>document.location='../pages/home.php'</script>";
        }
      }
    }
  }
}

 include('../accountant/backend/init.php');


//echo $_SESSION['acc_id'];
//echo $_SESSION['admin_id'];

$branch = $_SESSION['branch'];
$query = mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error($con));
  $row=mysqli_fetch_array($query);
           $branch_name=$row['branch_name'];

?>

<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header" style="padding-left:20px">
                <a href="home.php" class="navbar-brand"><strong style="font-size: 3rem;">@EasyTransact</strong></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->



                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-refresh text-red"></i> Re-Order
                            <span class="label label-danger">
                                <?php 
                      $query=mysqli_query($con,"select COUNT(*) as count from product where prod_qty<=reorder and branch_id='$branch'")or die(mysqli_error($con));
                			$row=mysqli_fetch_array($query);
                			echo @$row['count'];
                			?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo @$row['count'];?> products that needs reorder</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <?php
                        $queryprod=mysqli_query($con,"select prod_name from product where prod_qty<=reorder and branch_id='$branch'")or die(mysqli_error($con));
			  while($rowprod=mysqli_fetch_array($queryprod)){
			?>
                                    <li>
                                        <!-- start notification -->
                                        <a href="reorder.php?page=1">
                                            <i class="glyphicon glyphicon-refresh text-red"></i>
                                            <?php echo $rowprod['prod_name'];?>
                                        </a>
                                    </li><!-- end notification -->
                                    <?php }?>
                                </ul>
                            </li>
                            <li class="footer"><a href="reorder.php?page=1">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks Menu -->












                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-calendar text-red"></i> Expiries
                            <span class="label label-danger">
                                <?php 
                     // $date = date('y-m-d h:i:s');
                     // $dates=explode('-',$date);
                      $branch=$_SESSION['branch'];		
                        $start=date("Y/m/d");
                        $starty = date_create($start);
                       //$countant = '40';
                        $query=mysqli_query($con,"select b_expiry  from n_expiry where branch_id= '$branch'")or die(mysqli_error($con));
                        $row=mysqli_fetch_array($query);
                        $countant =  @$row['b_expiry'];
                        //echo $countants;
                      //@date_add($starty, date_interval_create_from_date_string("$countant days"));
                       $starts = date_format($starty, 'Y-m-d');
                      $query=mysqli_query($con,"select COUNT(*) as count from product where date(expiry) <= '$starts' and branch_id= '$branch'")or die(mysqli_error($con));
                			$row=mysqli_fetch_array($query);
                			echo $row['count'];
                			?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <strong><?php echo $row['count'];?></strong> products that about
                                to expire </li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <?php
                        $queryprod=mysqli_query($con,"select prod_name, expiry from product where date(expiry) <= '$starts' and branch_id='$branch'")or die(mysqli_error());
			  while($rowprod=mysqli_fetch_array($queryprod)){
			?>
                                    <li>
                                        <!-- start notification -->
                                        <a href="expiring.php">
                                            <i class="glyphicon glyphicon-refresh text-red"></i>
                                            <?php echo $rowprod['prod_name'];?>
                                        </a>
                                    </li><!-- end notification -->
                                    <?php }?>
                                </ul>
                            </li>
                            <li class="footer"><a href="expiring.php">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks Menu -->










                    <?php 
                      if(isset($_SESSION['super_admin_id']) || isset($_SESSION['acct_id']) || isset($_SESSION['admin_id'])){
                  ?>


                    <!-- Notifications Menu -->
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-wrench"></i> Settings

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <li>
                                        <!-- start notification -->
                                        <a href="expiry.php">
                                            <i class="glyphicon glyphicon-send text-green"></i> Expiry Settings
                                        </a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="category.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Category
                                        </a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="movement.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Stock Movement
                                        </a>
                                    </li><!-- end notification -->
                                    <!--   <li>start notification 
                            <a href="log.php">
                              <i class="glyphicon glyphicon-user text-green"></i> History Log
                            </a>
                          </li> end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="from_sup.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Product to Collect</a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="loyalty.php">
                                            <i class="glyphicon glyphicon-send text-green"></i> Loyalty Settings
                                        </a>
                                    </li><!-- end notification -->


                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- Tasks Menu -->























                    <!-- Notifications Menu -->
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-wrench"></i> Maintenance

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <?php /*  <li><!-- start notification -->
                            <a href="reprint.php">
                              <i class="glyphicon glyphicon-user text-green"></i> Re-Print Receipt
                            </a>
                          </li><!-- end notification -->
						          */?>
                                    <li>
                                        <!-- start notification -->
                                        <a href="supplier.php">
                                            <i class="glyphicon glyphicon-book text-green"></i> Supplier Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="debtors.php">
                                            <i class="glyphicon glyphicon-book text-green"></i> Debtors Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="creditors.php">
                                            <i class="glyphicon glyphicon-book text-green"></i> Creditors Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="supplier_old.php">
                                            <i class="glyphicon glyphicon-send text-green"></i> Supplier Old
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="customer.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Customer
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="product.php">
                                            <i class="glyphicon glyphicon-cutlery text-green"></i> Product
                                        </a>
                                    </li><!-- end notification -->


                                    <li>
                                        <!-- start notification -->
                                        <a href="re_goods.php">
                                            <i class="glyphicon glyphicon-send text-green"></i> Return Goods
                                        </a>
                                    </li><!-- end notification -->







                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- Tasks Menu -->
                    <?php }?>
                    <?php 
                      if(isset($_SESSION['super_admin_id']) || isset($_SESSION['acct_id']) || isset($_SESSION['admin_id'])){
                  ?>
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-stats text-red"></i> Sales Report

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">

                                    <li>
                                        <!-- start notification -->
                                        <a href="sales.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Full Report
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="report_per_product.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Report Per Article
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="report_per_product_ledger.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Report Per Article Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="sales_staff.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Sales by Staff
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="stock_sup.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Stocks by Supplier
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="sales_cust.php">
                                            <i class="glyphicon glyphicon-th-list text-redr"></i>Sales by Customer
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="devsup.php">
                                            <i class="glyphicon glyphicon-th-list text-redr"></i>Deficit/Supplus Report
                                        </a>
                                    </li><!-- end notification -->


                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- Tasks Menu -->








                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-stats text-red"></i> Ledgers

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">

                                    <li>
                                        <!-- start notification -->
                                        <a href="staffs.php">
                                            <i class="glyphicon glyphicon-user text-green"></i>Staffs
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="staff_ptf_ledger.php">
                                            <i class="glyphicon glyphicon-user text-green"></i>Staff PTF Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="staff_loan_ledger.php">
                                            <i class="glyphicon glyphicon-user text-green"></i>Staff Loan Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="expenses.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Expenses Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="lisare.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Lisare Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="daily.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Daily Sales Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="transfer_ret.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Retail Transfer Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="transfer_whole.php">
                                            <i class="glyphicon glyphicon-th-list text-redr"></i>Wholesale Transfer
                                            Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="surplus.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Suplus Ledger
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="devsup.php">
                                            <i class="glyphicon glyphicon-th-list text-redr"></i>Deficit Ledger
                                        </a>
                                    </li><!-- end notification -->




                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- Tasks Menu -->


                    <?php /*
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-stats text-red"></i> Ledgers
                     
                    </a>
                    <ul class="dropdown-menu">
                     <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                        
                          <li><!-- start notification -->
                            <a href="staffs.php">
                              <i class="glyphicon glyphicon-user text-green"></i>Staffs
                            </a>
                          </li><!-- end notification -->

                          <li><!-- start notification -->
                            <a href="expenses.php">
                              <i class="glyphicon glyphicon-ok text-green"></i>Expenses Ledger
                            </a>
                          </li><!-- end notification -->

                          <li><!-- start notification -->
                            <a href="lisare.php">
                              <i class="glyphicon glyphicon-ok text-green"></i>Lisare Ledger
                            </a>
                          </li><!-- end notification -->

						              <li><!-- start notification -->
                            <a href="daily.php">
                                  <i class="glyphicon glyphicon-usd text-blue"></i>Daily Sales Ledger
                              </a>
                          </li><!-- end notification -->

                          <li><!-- start notification -->
                            <a href="transfer_ret.php">
                                  <i class="glyphicon glyphicon-usd text-blue"></i>Retail Transfer Ledger
                              </a>
                          </li><!-- end notification -->
					    
						               <li><!-- start notification -->
                              <a href="transfer_whole.php">
                                <i class="glyphicon glyphicon-th-list text-redr"></i>Wholesale Transfer Ledger
                              </a>
                            </li><!-- end notification -->  

                            <li><!-- start notification -->
                            <a href="surplus.php">
                                  <i class="glyphicon glyphicon-usd text-blue"></i>Suplus Ledger
                              </a>
                          </li><!-- end notification -->
					    
						               <li><!-- start notification -->
                              <a href="devsup.php">
                                <i class="glyphicon glyphicon-th-list text-redr"></i>Deficit Ledger
                              </a>
                            </li><!-- end notification -->  

                           
                           
                                              
                        </ul>
                      </li>

                    </ul>
                  </li>
                  <!-- Tasks Menu -->
                        */?>














                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-stats text-red"></i> Report

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">

                                    <li>
                                        <!-- start notification -->
                                        <a href="income.php">
                                            <i class="glyphicon glyphicon-th-list text-redr"></i>Wholesale Income
                                        </a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="income_ret.php">
                                            <i class="glyphicon glyphicon-th-list text-redr"></i>Retail Income
                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <a href="inventory.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Inventory
                                        </a>
                                    </li>
                                    <li>
                                        <!-- start notification -->
                                        <a href="bank_history_ledger.php">
                                            <i class="glyphicon glyphicon-ok text-green"></i>Bank History Ledger
                                        </a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <a href="wayreport.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Way Bill Report
                                        </a>
                                    </li><!-- end notification -->


                                    <li>
                                        <!-- start notification -->
                                        <a href="bank_history.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Bank History </a>
                                    </li><!-- end notification -->




                                    <li>
                                        <!-- start notification -->
                                        <a href="purchase_request.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Purchase Request
                                        </a>
                                    </li><!-- end notification -->


                                    <li>
                                        <!-- start notification -->
                                        <a href="daily.php">
                                            <i class="glyphicon glyphicon-usd text-blue"></i>Daily Sales Report
                                        </a>
                                    </li><!-- end notification -->

                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- Tasks Menu -->
                    <?php 
                       }
                  ?>
                    <?php 
                      if(isset($_SESSION['super_admin_id'])){
                  ?>
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="../accountant/index.php">
                            <i class="glyphicon glyphicon-list text-green"></i>Mgt Portal

                        </a>

                    </li>


                    <?php 
                       }
                  ?>


                    <?php 
                      if(isset($_SESSION['acct_id'])){
                  ?>
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="../accountant/index.php">
                            <i class="glyphicon glyphicon-list text-green"></i>Mgt Portal

                        </a>

                    </li>


                    <?php 
                       }
                  ?>




                    <?php 
                      if(isset($_SESSION['admin_id'])){
                  ?>
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="../accountant/index.php">
                            <i class="glyphicon glyphicon-list text-green"></i>Mgt Portal

                        </a>

                    </li>


                    <?php 
                       }
                  ?>




                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-stats text-red"></i> Manage Profile

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">

                                    <li>
                                        <!-- start notification -->
                                        <a href="profile.php" class="dropdown-toggle">
                                            <i class="glyphicon glyphicon-cog text-orange"></i>
                                            <?php echo $_SESSION['name'];?>
                                        </a>
                                    </li><!-- end notification -->
                                    <li>
                                        <!-- start notification -->
                                        <!-- Menu Toggle Button -->
                                        <a href="logout.php" class="dropdown-toggle">
                                            <i class="glyphicon glyphicon-off text-red"></i> Logout

                                        </a>
                                    </li><!-- end notification -->

                                    <li>
                                        <!-- start notification -->
                                        <!-- Menu Toggle Button -->
                                        <a href="http://localhost/bmd" class="dropdown-toggle">
                                            <i class="glyphicon glyphicon-book text-red"></i> BackUp Database

                                        </a>
                                    </li><!-- end notification -->


                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- Tasks Menu -->







                </ul>
            </div><!-- /.navbar-custom-menu -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
