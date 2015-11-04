<?php
session_start();
include("common.php");

$user = $_SESSION['name'];
?>

<html>
<head>
<title>Maps</title>

<!--  _________________ Begin Link to the CSS page ___________________________ -->

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleMapcheck.css" rel="stylesheet" type="text/css" media="all" /> 


<!--  _________________ End Link to the CSS page ___________________________ -->

<script type="text/javascript"> function setfocus() { document.forms[0].stno.focus() } </script> 

<script language="javascript" type="text/javascript"> 
<!-- 
function popitup(url) { 
	newwindow=window.open(url,'name','toolbar,status,resizable,scrollbars,height=600,width=1000'); 
	if (window.focus) {newwindow.focus()} 
	return false; 
} 
// --> 
</script> 


</head>

<body >

              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>
         
<form name="form1" method="post" action="">
<div id="inpform"> 
         <div id="stnoLabel"> 
              Street#:
         </div>
              <input tabindex=7 class="stnoInput" name="stno" maxlength="10" size=10 type="text" id="stno" value="<?php echo $stno?>">
         

         <div id="stnmLabel">
              Street Name: 
         </div>
              <input tabindex=8 class="stnmInput" name="stnm" maxlength="20" size=20 type="text" id="stnm" value="<?php echo $stnm?>">
         

         <div id="cityLabel">
              City:
         </div>
              <input tabindex=9 class="cityInput" name="city" maxlength="20" size=20 type="text" id="city" value="<?php echo $city?>">
         

         <div id="stateLabel">
              State:
         </div>
            <input tabindex=10 class="stateInput" name="state" maxlength="2" size=2 type="text" id="state" value="<?php echo $state?>">
   <br>          
            <input class="addRecordButton" type="submit" name="Submit" value="Get Map" >
            <input class="MainBut" type="button" value="Main Menu" onClick="window.location='admin.php'">
            <input class="BackBut" type="button" value="Back" onClick="window.location='special.php'"></button>

</div>
<?php
if(isset($_POST['Submit']))
{
$stno = $_POST['stno'];
$stnm = $_POST['stnm'];
$city = $_POST['city'];
$state = $_POST['state'];

?>
<div id="main">
<div id="maptext">
Select Mapping Service
</div>
<br>
<input class="map" type="button" value="Google" 
onclick="return popitup('http://maps.google.com/maps?f=q&hl=en&q=<?php echo $stno ?>+<?php echo $stnm ?>+<?php echo $city ?>+<?php echo $state ?>')">
 <br>          
<input class="map2" type="button" value="Mapquest" 
onclick="return popitup('http://www.mapquest.com/maps/map.adp?formtype=address=&address=<?php echo $stno ?>%20<?php echo $stnm ?> &city=<?php echo $city ?> &state=<?php echo $state ?> ')">
 <br>         
<input class="map3" type="button" value="Yahoo"  
onclick="return popitup('http://maps.yahoo.com/maps_result?addr=<?php echo $stno ?>+<?php echo $stnm ?>&csz=<?php echo $city ?>%2C+<?php echo $state ?>&country=us&new=1&name=&qty= ') ">
</div>

<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">
<input class="BackButton" type="button" value="Back" onClick="window.location='mapcheck.php'"></button>
<input class="specialbutton" type="button" value="Special Features" onClick="window.location='special.php'"></button>


<?php
}
?>

</form>

</body>
</html>
