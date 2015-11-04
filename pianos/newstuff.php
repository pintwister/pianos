<?php

// remove commas from money formatted data
      $servamnt = ereg_replace(',','', $servamnt);

// convert number data to money
      $servamnt = number_format($servamnt,2);



// set up todays date
      $date1 = date("m");
      $date2 = date("d");
      $date3 = date("Y");
      $date = $date1 . '/' . $date2 . '/' . $date3;

// set up from data format to american format
      $date1 = substr($ldate,4,2);
      $date2 = substr($ldate,6,2);
      $date3 = substr($ldate,0,4);
      $date = $date1 . '/' . $date2 . '/' . $date3;

// convert from american format to data format
       $date1 = substr($date,6,4);
       $date2 = substr($date,0,2);
       $date3 = substr($date,3,2);
       $date = $date1 . $date2 . $date3;



// check for blank date
      if($date1 < 1):
      $ndate = '';
      endif;

?>


<html>
<head>
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">


<script type="text/javascript"> function setfocus() { document.forms[0].date.focus() } 

</head>

<BODY onload=setfocus()>

              <div id="DateLabel">
                   Date:
              </div>
 
              <div id="DateInput">
              <input onfocus=select() type="text" name="date" value="<? echo $date ?>" tabindex=1 />

			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date'
			});
	  		</script>
              </div>


