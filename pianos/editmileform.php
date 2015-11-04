<?php
session_start();
include("common.php");

$user = $_SESSION['name'];

$date = $_SESSION['date'];
$start = $_SESSION['start'];
$end = $_SESSION['end'];
$expl = $_SESSION['expl'];

?>

<html> 
<head>
<title>Edit Mileage</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleEditmile.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">

<script type="text/javascript"> function setfocus() { document.forms[0].date.focus()}

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


<form name="form" action="editmile.php" method="post">
              <div id="EntryText">
                     Date of Entry:
              </div>

                  <input onfocus=select() class="Entry" type="text" name="date" value="<?php echo $date ?>" tabindex=1 />

               <div id="Entry">
               	<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date'
			});
	  		</script>

               </div>

              <div id="StartText">
                     Starting Mileage:
              </div>
              <div class="Start">
                    <input name="start" onfocus=select() tabindex=2 type="text" value="<?php echo $start ?>">  
              </div>

              <div id="EndText">
                     Ending Mileage:
              </div>
              <div class="end">
                    <input name="end" onfocus=select() tabindex=3 type="text" value="<?php echo $end ?>"> 
              </div>
                           
              <div id="DestText">
                     Destination:
              </div>
              <div class="Dest">
                    <input name="expl" onfocus=select() tabindex=4 type="text" value="<?php echo $expl ?>"> 
              </div>


<input class="CommitButton" type="submit" name="Submit" value="Commit" >
<input class="CancelButton" type="button" name="Return" value="Cancel" onClick="window.location='viewmile.php'">

</form>

		

</body></html>