<?php
session_start();
include("common.php");

$user = $_SESSION['name'];

if (isset($_POST['Submit']))
{
header("location: listname.php");
 }


?>
<html>
<head>
<title>Search for Names</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleSearchname.css" rel="stylesheet" type="text/css" media="all" /> 


<script type="text/javascript"> function setfocus() { document.forms[0].first.focus() } 


</script> 
</head>


<body onload=setfocus()>
        
            <div id="logout">
                   <a href="index.php">Logout ... </a>
                   <span><?php echo $user ?></span>
            </div>

            <div id="UseToSearchText">
                   Use this form to Search your Database !
            </div>

<form name="form" method="post" action="">

         
            <select class="firstfield" name="firstfield">
                <option value="fname">First Name</option>
                <option value="lname" selected="selected">Last Name</option>
                <option value="stno">Street Number</option>
                <option value="stnm">Street Name</option>
                <option value="city">City</option>
                <option value="state">State</option>
                <option value="phone">Home Phone</option>
                <option value="comments">Comments</option>
                <option value="ID">Customer #</option>

            </select>
           
            <select class="firstcompare" name="firstcompare">
                <option value="1" selected="selected">Begins With</option>
                <option value="2">Contains</option>
                
            </select>
 
                <input class="first" maxlength="30" size=30 name="first" type="text" id="first" value=" ">
         
            <select class="secondfield" name="secondfield">
               <option value="fname" selected="selected">First Name</option>
               <option value="lname">Last Name</option>
               <option value="stno">Street Number</option>
               <option value="stnm">Street Name</option>
               <option value="city">City</option>
               <option value="state">State</option>
               <option value="phone">Home Phone</option>
               <option value="comments">Comments</option>
               
           </select>
         
           <select class="secondcompare" name="secondcompare">
               <option value="1" selected="selected">Begins With</option>
               <option value="2">Contains</option>
               
           </select>
 
           <input class="second" maxlength="30" size=30 name="second" type="text" id="second" value=" ">

              <input class="SearchButton" type="submit" name="Submit" value="Search">
          
              <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
         
<?php

$_SESSION['firstfield'] = $_POST['firstfield'];
$_SESSION['first'] = $_POST['first'];
$_SESSION['firstcompare'] = $_POST['firstcompare'];

$_SESSION['secondfield'] = $_POST['secondfield'];
$_SESSION['second'] = $_POST['second'];
$_SESSION['secondcompare'] = $_POST['secondcompare'];


?>

</form>

           <div id="LeaveEmptyText">
               Leave all Search Boxes empty to load entire database !
           </div>
</body>
</html>
