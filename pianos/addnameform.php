<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
?>
 
 <html>
<head>
<title>Add Names</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleAddname.css" rel="stylesheet" type="text/css" media="all" />  
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">

<script type="text/javascript"> function setfocus() { document.forms[0].fname.focus() } 

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

         <div id="AddNewText">
              Add New Record
         </div>

<form name="form" action="addname.php" method="post"><br>

         <div id="fnameLabel">
              First Name:
         </div>
              <input tabindex=1 class="fnameInput" name="fname" maxlength="30" size=32 type="text">
         

         <div id="lnameLabel">
              Last Name:
         </div>
              <input tabindex=2 class="lnameInput" name="lname" maxlength="30" size=32 type="text">
        
         <div id="feeLabel">
              Fee:
         </div>
              <input tabindex=3 class="feeInput" name="fee" maxlength="3" size=3 type="text">
        
         <div id="NextApptLabel">
              Next Appointment:
         </div>

                       <input class="NextApptInput" tabindex=4 type="text" name="date" />

         <div id="NextApptInput">
               	     <script language="JavaScript">
			     new tcal ({
			     'formname': 'form',
			     'controlname': 'date'
			     });
	  		</script>
         </div>

         <div id="stnoLabel"> 
              Street#:
         </div>
              <input tabindex=5 class="stnoInput" name="stno" maxlength="10" size=10 type="text">
         

         <div id="stnmLabel">
              Street Name: 
         </div>
              <input tabindex=6 class="stnmInput" name="stnm" maxlength="20" size=20 type="text">
         

         <div id="cityLabel">
              City:
         </div>
              <input tabindex=7 class="cityInput" name="city" maxlength="20" size=20 type="text">
         

         <div id="stateLabel">
              State:
         </div>
              <input tabindex=8 class="stateInput" name="state" maxlength="2" size=2 type="text">
         

         <div id="zipLabel">
              Zip:
         </div>
              <input tabindex=9 class="zipInput" name="zip" maxlength="5" size=5 type="text">
         

         <div id="phoneLabel">
              Primary Phone:
         </div>

         <div id="phoneInput">
              (
              <small><input class="phone1" name="phone1" tabindex=10 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
              <small><input class="phone2" name="phone2" tabindex=11 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
              <small><input class="phone3" name="phone3" tabindex=12 size="5" maxlength="4"></small>
         </div>

         <div id="landlineLabel">
              Land Line:
         </div>

         <div id="landlineInput">
              (
              <small><input class="landline1" name="landline1" tabindex=13 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
              <small><input class="landline2" name="landline2" tabindex=14 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
              <small><input class="landline3" name="landline3" tabindex=15 size="5" maxlength="4"></small>
         </div>

         <div id="cell1Label">
              Cell #1:
         </div>

         <div id="cell1Input">
              (
              <small><input class="cell11" name="cell11" tabindex=16 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
              <small><input class="cell12" name="cell12" tabindex=17 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
              <small><input class="cell13" name="cell13" tabindex=18 size="5" maxlength="4"></small>
         </div>

         <div id="cell2Label">
              Cell #2:
         </div>

         <div id="cell2Input">
              (
              <small><input class="cell21" name="cell21" tabindex=19 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
              <small><input class="cell22" name="cell22" tabindex=20 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
              <small><input class="cell23" name="cell23" tabindex=21 size="5" maxlength="4"></small>
         </div>

         <div id="emailLabel"> 
              E-Mail:
         </div>
              <input tabindex=22 class="emailInput" name="email" maxlength="40" size=40 type="text">


         <div id="commentsLabel">
              Comments:
         </div>

         <div id="commentsInput">
              <textarea tabindex=23 name="comments" rows="4" cols="96"></textarea>
         </div>
              <input class="addRecordButton" type="submit" name="Submit" value="Commit">
              <input class="returnButton" type="button" value="Cancel" onClick="window.location='admin.php'">
         
</form>


</body>
</html>
