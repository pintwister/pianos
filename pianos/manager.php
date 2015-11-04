<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
$_SESSION['id'] = 1;
?>
<html>

<head>
<title>Database Manager</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleManager.css" rel="stylesheet" type="text/css" media="all" /> 

</head>


<BODY>
              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

        
           <a class="AddNewLink" href="adduserform.php">Add New User </a>
        
           <a class="ListLink" href="listusers.php">List All users</a>
        

           <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
</body>
</html>
