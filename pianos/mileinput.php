<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
$userid = $_SESSION['userid']; 

// set up date1
      $date1a = '01';
      $date2a = '01';
      $date3a = '2015';
      $date1 = $date1a . '/' . $date2a . '/' . $date3a;

// set up date2
      $date1b = '12';
      $date2b = '31';
      $date3b = '2015';
      $date2 = $date1b . '/' . $date2b . '/' . $date3b;


?>

<head>
<title>Add Mileage</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleAppt.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">

<script type="text/javascript"> function setfocus() { document.forms[0].date1.focus() } 

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

<form name=form action="listmile.php" method="post">

           <div id="GreaterThanText">
                Greater Than or Equal to
           </div>

           <div id="GreaterThanInput">
               <input onfocus=select() type="text" name="date1" value="<?php echo $date1 ?>" tabindex=1 />

			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date1'
			});
	  		</script>

           </div>
     
            
          <div id="LessThanText">
               Less Than or Equal to
          </div>
         
          <div id="LessThanInput">
             <input onfocus=select() type="text" name="date2" value="<?php echo $date2 ?>" tabindex=1 />

			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date2'
			});
	  		</script>

          </div>



          <input class="ViewServiceButton" type="Submit"  name="Submit1" value="View/Print Mileage" >

</form>


<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">
<input class="BackButton" type="button" value="Back" onClick="window.location='mileage.php'"></button>

</body>

