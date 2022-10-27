<?php
//$con = mysqli_connect("localhost","root","","deshalom");

$con = mysqli_connect("localhost","root","","easy_transact_db");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to Database: " . mysqli_connect_error();
  }

  date_default_timezone_set("Africa/Lagos"); 
?>



