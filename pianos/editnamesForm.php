
<?php
session_start();
include("common.php");

$user = $_SESSION['name'];

      $fname = $_SESSION['mfname'];
      $lname = $_SESSION['mlname'];
      $fee = $_SESSION['fee'];
      $stno = $_SESSION['mstno'];
      $stnm = $_SESSION['mstnm'];
      $city = $_SESSION['mcity'];
      $email = $_SESSION['memail'];
      $state = $_SESSION['mstate'];
      $zip = $_SESSION['mzip'];
      $phone = $_SESSION['mphone'];
      $landline = $_SESSION['mlandline'];
      $cell1 = $_SESSION['mcell1'];
      $cell2 = $_SESSION['mcell2'];
      
      $phone1 = substr($phone,0,3);
      $phone2 = substr($phone,3,3);
      $phone3 = substr($phone,6,4);
            
      $landline1 = substr($landline,0,3);
      $landline2 = substr($landline,3,3);
      $landline3 = substr($landline,6,4);
      
      $cell11 = substr($cell1,0,3);
      $cell12 = substr($cell1,3,3);
      $cell13 = substr($cell1,6,4);
      
      $cell21 = substr($cell2,0,3);
      $cell22 = substr($cell2,3,3);
      $cell23 = substr($cell2,6,4);
      
      
$ndate = $_SESSION['mndate'];

// convert from american format to data format
       $date1 = substr($ndate,6,4);
       $date2 = substr($ndate,0,2);
       $date3 = substr($ndate,3,2);
       $xndate = $date1 . $date2 . $date3;

// check for blank date
if($xndate < 1):
$ndate = '';
endif;

      $comments = $_SESSION['mcomments'];

?>

<html> 
<head>
<title>Edit Names</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="./style/styleEditname.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">

<script type="text/javascript"> function setfocus() { document.forms[0].fname.focus()}

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

<form name="form" action="editnames.php" method="post">
<div id="fnameLabel">
               First Name:
         </div>
               <input tabindex=1 class="fnameInput" onfocus=select() maxlength="30" size=32 name="fname" type="text" value="<?php echo $fname?>">
       
         <div id="lnameLabel">
               Last Name:
         </div>
              <input tabindex=2 class="lnameInput" onfocus=select() maxlength="30" size=32 name="lname" type="text" value="<?php echo $lname?>"> 
         
         <div id="feeLabel">
               Fee:
         </div>
              <input tabindex=3 class="feeInput" onfocus=select() maxlength="3" size=3 name="fee" type="text" value="<?php echo $fee?>"> 

         <div id="NextApptLabel">
               Next Appointment:
         </div>
                  <input onfocus=select() class="NextApptInput" type="text" name="ndate" value="<?php echo $ndate ?>" tabindex=4 />

         <div id="NextApptInput">
               
			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'ndate'
			});
	  		</script>

         </div>


         <div id="stnoLabel">
              Street#:
         </div>
              <input tabindex=5 class="stnoInput" onfocus=select() maxlength="10" size=10 name="stno" type="text" value="<?php echo $stno?>">
         
         <div id="stnmLabel">
              Street Name:
         </div>
              <input tabindex=6 class="stnmInput" onfocus=select() maxlength="20" size=20 name="stnm" type="text" value="<?php echo $stnm?>">
         
         <div id="cityLabel">
              City:
         </div>
              <input tabindex=7 class="cityInput" onfocus=select() maxlength="20" size=20 name="city" type="text" value="<?php echo $city?>">
         
         <div id="stateLabel">
              State:
         </div>
              <input tabindex=8 class="stateInput" onfocus=select() maxlength="2" size=2 name="state" type="text" value="<?php echo $state?>">
         
         <div id="zipLabel">
              Zip:
         </div>
               <input tabindex=9 class="zipInput" onfocus=select() maxlength="5" size=5 name="zip" type="text" value="<?php echo $zip?>">
<div id="phoneLabel">   
               Primary Phone:
         </div>

         <div id="phoneInput">
               (
               <small><input class="phone1" onfocus=select() name="phone1" value="<?php echo $phone1 ?>" tabindex=10 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
               <small><input class="phone2" onfocus=select() name="phone2" value="<?php echo $phone2 ?>" tabindex=11 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
               <small><input class="phone3" onfocus=select() name="phone3" value="<?php echo $phone3 ?>" tabindex=12 size="5" maxlength="4"></small>
         </div>
         
<div id="landlineLabel">   
               Land Line:
         </div>

         <div id="landlineInput">
               (
               <small><input class="landline1" onfocus=select() name="landline1" value="<?php echo $landline1 ?>" tabindex=13 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
               <small><input class="landline2" onfocus=select() name="landline2" value="<?php echo $landline2 ?>" tabindex=14 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
               <small><input class="landline3" onfocus=select() name="landline3" value="<?php echo $landline3 ?>" tabindex=15 size="5" maxlength="4"></small>
         </div>


         <div id="cell1Label">   
               Cell #1:
         </div>

         <div id="cell1Input">
               (
               <small><input class="cell11" onfocus=select() name="cell11" value="<?php echo $cell11 ?>" tabindex=16 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
               <small><input class="cell12" onfocus=select() name="cell12" value="<?php echo $cell12 ?>" tabindex=17 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
               <small><input class="cell13" onfocus=select() name="cell13" value="<?php echo $cell13 ?>" tabindex=18 size="5" maxlength="4"></small>
         </div>

         <div id="cell2Label">   
               Cell #2:
         </div>

         <div id="cell2Input">
               (
               <small><input class="cell21" onfocus=select() name="cell21" value="<?php echo $cell21 ?>" tabindex=19 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small>)  
               <small><input class="cell22" onfocus=select() name="cell22" value="<?php echo $cell22 ?>" tabindex=20 onKeyUp="return autoTab(this, 3, event);" size="4" maxlength="3"></small> - 
               <small><input class="cell23" onfocus=select() name="cell23" value="<?php echo $cell23 ?>" tabindex=21 size="5" maxlength="4"></small>
         </div>

         <div id="emailLabel">
              E-Mail:
         </div>
              <input tabindex=22 class="emailInput" onfocus=select() maxlength="40" size=40 name="email" type="text" value="<?php echo $email?>">

         <div id="commentsLabel">
               Comments:
         </div>

         <div id="commentsInput">
               <textarea tabindex=23 name="comments" rows="4" cols="96"><?php echo $comments?></textarea>
         </div>



                 <input class="submitButton" type="submit" name="Submit" value="Commit">
                 <input class="backButton" type="button" value="Cancel" onClick="window.location='viewnames.php'">

</form> 

</body></html>