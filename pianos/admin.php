<?php
session_start();
include("common.php");

$user = $_SESSION['name'];

?>
<html>
<head>
<head>
<title>Database</title>

<!--  _________________ Begin Link to the CSS page ___________________________ -->

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleAdmin.css" rel="stylesheet" type="text/css" media="all" /> 


<!--  _________________ End Link to the CSS page ___________________________ -->

</head>
<body>

              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

                             
       <div ID="main">
                Welcome ... <span style="color: #bb0000;"><?php echo $user ?></span>
           
                    
           <div id="menu">

                    <a href="searchname.php" >Search for Customer</a> <br>
                    <a href="addnameform.php" >Add New Record</a> <br>
                     
                 <?php 
                 if( $_SESSION['admin'] == 1)
                 {
                 ?>
                    <a href="manager.php">User Administration</a><br>
                 <?php
                 }
                 ?>



                 <?php
                 if($_SESSION['admin'] != 1)
                 {
                 ?>
                    <a href="listcharge.php">Who owes me Money ?</a><br>
                    <a href="mileage.php">Mileage</a><br>
                    <a href="appointments.php">Monthly Appointments</a><br>
                 <?php
                 }
                 ?>

                    <a href="special.php">Special Features</a><br>
                    
           </div>
       </div>



</body>
</html>

