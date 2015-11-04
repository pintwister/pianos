<html><head></head>
<body>

<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$admin = $_SESSION['admin'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

?>

<html>

<head>
<title>Edit User</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="./style/styleEdituser.css" rel="stylesheet" type="text/css" media="all" /> 

<script type="text/javascript"> function setfocus() { document.forms[0].username.focus() } 

var isNN = (navigator.appName.indexOf("Netscape")!=-1);
function autoTab(input,len, e) {
var keyCode = (isNN) ? e.which : e.keyCode; 
var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
if(input.value.length >= len && !containsElement(filter,keyCode)) {
input.value = input.value.slice(0, len);
input.form[(getIndex(input)+1) % input.form.length].focus();
}
function containsElement(arr, ele) {
var found = false, index = 0;
while(!found && index < arr.length)
if(arr[index] == ele)
found = true;
else
index++;
return found;
}
function getIndex(input) {
var index = -1, i = 0, found = false;
while (i < input.form.length && index == -1)
if (input.form[i] == input)index = i;
else i++;
return index;
}
return true;
}
//  End -->

</script> 
</head>

<body onload=setfocus()>

              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

         <div id="EditRecordText">  
               EditRecord
         </div>

<form name="form" action="edituser.php" method="post">

         <div id="UserNameLabel">
               Username:
         </div>

         <input class="UsernameInput" onfocus=select() name="username" value="<?php echo $username ?>" tabindex=1 size="30" maxlength="30" type="text"> 

         <div id="PasswordLabel">
               Password:
         </div>
               <input class="PasswordInput" onfocus=select() name="password" value="<?php echo $password ?>" tabindex=2 size=30 maxlength="30" type="password">
 
         <div id="AdminLabel">
               Administrator:
         </div>
               <input class="AdminInput" onfocus=select() name="admin" value="<?php echo $admin ?>" tabindex=3 size="1" maxlength="1" type="text"> 

         <div id="FirstNameLabel">
               First Name:
         </div>
               <input class="FirstNameInput" onfocus=select() name="firstname" value="<?php echo $firstname ?>" tabindex=4 size="20" maxlength="20" type="text"> 
 
         <div id="LastNAmeLabel">
               Last Name:
         </div>
               <input class="LastNameInput" onfocus=select() name="lastname" value="<?php echo $lastname ?>" tabindex=5 size="20" maxlength="20" type="text"> 

               <input class="SubmitButton" type="submit" name="Submit" value="Commit">
               <input class="BackButton" type="button" value="Cancel" onClick="window.location='viewuser.php'">
               
 
		

</form>

</body></html>