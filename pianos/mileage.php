<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
?>

<html>
<head>
<title>Mileage</title>

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
                Mileage<span style="color: #bb0000;"></span>
           
           <div id="menu">

                    <a href="addmileform.php">Update Mileage Log</a><br>
                    <a href="mileinput.php">List/Print Mileage Log</a><br>
                    
           </div>
       </div>
<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">

</body>
</html>

