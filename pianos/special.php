<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
?>

<html>
<head>
<title>Special Features</title>

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

                    <a href="mapcheck.php">Check Address</a><br>
                    <a href="payment.html">Payment Calculator</a><br>
                    <a href="BuyOrLease.html">Lease Calculator</a><br>
                    <a href="admin.php">Main Menu</a>
           </div>
       </div>
</body>
</html>
