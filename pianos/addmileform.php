
<?php
session_start();
include("common.php");

// $time1 = date('g:i A');
// echo "Time" . '<br>' . $time1;

// set up todays date

      $date1 = date("m");
      $date2 = date("d");
      $date3 = date("Y");

      $date = $date1 . '/' . $date2 . '/' . $date3;

?>

<head>

<title>Add Mileage</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleAddMile.css" rel="stylesheet" type="text/css" media="all" /> 

<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">

<script type="text/javascript"> function setfocus() { document.forms[0].date.focus() } 

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
<BODY onload=setfocus()>
	
    
    
 <form name="form" action="addmile.php" method="post"><br>

              <div id="DateLabel">
                   Date:
              </div>

                  <input onfocus=select() class="DateInput" type="text" name="date" value="<?php echo $date ?>" tabindex=1 />
 
              <div id="DateInput">
              	<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date'
			});
	  		</script>
              </div>
               
              <div id="StartLabel">
                   Starting Mileage:
              </div>
                   <input class="StartInput" tabindex=2 maxlength="10" size=10 name="start" type="text" id="start">

              <div id="EndLabel">
                   Ending Mileage:
              </div>
                   <input class="EndInput" tabindex=3 maxlength="10" size=10 name="end" type="text" id="end" >
  
              <div id="ExplLabel">
                   Explanation:
              </div>
                   <input class="ExplInput" tabindex=4 maxlength="40" size=41 name="expl" type="text" id="expl" >

              
  
                   <input class="SubmitButton" type="submit" name="Submit" value="Commit"></button>
                   <input class="CancelButton" type="button" value="Cancel" onClick="window.location='mileage.php'">

 </form> 

</body>
</html>
