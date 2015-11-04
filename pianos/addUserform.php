<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
?>

<html>
<head>
<title>Add User</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleAdduser.css" rel="stylesheet" type="text/css" media="all" /> 

<script type="text/javascript"> function setfocus() { document.forms[0].username.focus() } 
</script> 
</head>

 <body onload=setfocus()>
        
              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

<form action="adduser.php" method="post">
           <div id="usernameLabel"> 
                 Username:
           </div>
                <input class="usernameInput" name="username" tabindex=1 size="30" maxlength="30" type="text"> 

           <div id="passwordLabel">
                Password:
           </div>
                <input class="passwordInput" name="password" tabindex=2 size=30 maxlength="30" type="password">

           <div id="adminLabel">
                Standard user = 0 ... Administrator = 1
           </div>
                <input class="adminInput" name="admin" value="0" tabindex=3 size="1" maxlength="1" type="text"> 

           <div id="FirstNameLabel">
                First Name:
           </div>
                <input class="FirstNameInput" name="firstname"  tabindex=4 size="20" maxlength="20" type="text"> 

           <div id="LastNameLabel">
                last Name:
           </div>
                <input class="LastNameInput" name="lastname" tabindex=5 size="20" maxlength="20" type="text"> 

                <input class="AddButton" type="submit" name="Submit" value="Add New User">

                <input class="ReturnButton" type="button" value="Return" onClick="window.location='manager.php'">

 
</body>
</html>

