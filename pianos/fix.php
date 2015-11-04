<?php
// open connection to MongoDB server
  			$conn = new Mongo('localhost');

// access database
  			$db = $conn->pianos;

// **********************************************

// connect to a MySql server

 			$con = mysql_connect("localhost","pintwister","pitboss");

// connect to a MySql database
			mysql_select_db("pianos", $con);

// select a record/records from MySql table
			$result = mysql_query("SELECT * FROM names");

			while($row = mysql_fetch_array($result))
			{

			// store rows to variables
			$id = $row['id'];
			$fuserid = $row['userid'];
			$gfname = $row['fname'];
			$glname = $row['lname'];
			$ffee = $row['fee'];
			$fstno = $row['stno'];
			$fstnm = $row['stnm'];
			$fcity = $row['city'];
			$fstate = $row['state'];
			$fzip = $row['zip'];
			$fphone = $row['phone'];

	$fldate = $row['ldate'];
                  $flyear = substr($fldate,0,4);
                  $flmonth = substr($fldate,5,2);
                  $flday = substr($fldate,8,2);
                  $fldate = $flyear . $flmonth . $flday;
	$fndate = $row['ndate'];
                  $fnyear = substr($fndate,0,4);
                  $fnmonth = substr($fndate,5,2);
                  $fnday = substr($fndate,8,2);
                  $fndate = $fnyear . $fnmonth . $fnday;

			$fcharge = $row['charge'];
			$fpayment = $row['payment'];
			$ftotal = $row['total'];
			$flandline = $row['landline'];
			$fcell1 = $row['cell1'];
			$fcell2 = $row['cell2'];
			$femail = $row['email'];
			$fcomments = $row['comments'];


// define a new MONGO document with safe insert
// access collection
  							      $collection = $db->names;

  								$item = array(
								'id' => $id,
                                                'userid' => $fuserid,
     								'fname' => $gfname,
     								'lname' => $glname,
     								'fee' => $ffee,
     								'stno' => $fstno,
     								'stnm' => $fstnm,
     								'city' => $fcity,
     								'state' => $fstate,
     								'zip' => $fzip,
     								'phone' => $fphone,
     								'ldate' => $fldate,
     								'ndate' => $fndate,
     								'comments' => $fcomments,
     								'charge' => $fcharge,
     								'payment' => $fpayment,
     								'total' => $ftotal,
     								'landline' => $flandline,
     								'cell1' => $fcell1,
     								'cell2' => $fcell2,
     								'email' => $femail,
     
								);
    
  								$options = array("safe" => True);

								// insert the new document
  								$collection->insert($item,$options);


// select related MySql service record
					$result2 = mysql_query("SELECT * FROM service WHERE namesid=$id");

					while($row = mysql_fetch_array($result2))
					{

					// store rows to variables
					// $namesid = $row['namesid'];

			$fsdate = $row['sdate'];
                              $fsyear = substr($fsdate,0,4);
                              $fsmonth = substr($fsdate,5,2);
                              $fsday = substr($fsdate,8,2);
                              $fsdate = $fsyear . $fsmonth . $fsday;

					$fserv = $row['serv'];
					$fservamnt = $row['servamnt'];
					$fchkno = $row['chkno'];
					$fpartamnt = $row['partamnt'];
					$fcomment = $row['comment'];
					$fchgno = $row['chgno'];

// Add Service records to MONGO
$service = array('sdate' => $fsdate, 'serv' => $fserv, 'servamnt' => $fservamnt, 'chkno' => $fchkno, 'partamnt' => $fpartamnt, 'comment' => $fcomment, 'chgno' => $fchgno);


// Store ID field to variable 
  								$criteria = array('id' => $id,);
 
// Find current document by ID Variable 
								$obj = $collection->findOne($criteria);
								$upsert = true; 
								$collection->update($obj, array('$push' => $service), array("upsert" => $upsert));

// end Service loop
					}

// end names loop
			}

// select a record/records from MySql table
			$result3 = mysql_query("SELECT * FROM users");
			while($row = mysql_fetch_array($result3))
			{

			// store rows to variables
			$id = $row['id'];
			$fusername = $row['username'];
			$fpassword = $row['password'];
			$fadmin = $row['admin'];
			$gfname = $row['firstname'];
			$glname = $row['lastname'];

// define a new MONGO document with safe insert
// access collection
  								$collection = $db->users;

  								$item = array(
								'id' => $id,
                                                'username' => $fusername,
     								'password' => $fpassword,
     								'admin' => $fadmin,
     								'firstname' => $gfname,
     								'lastname' => $glname,
								);
    
  								$options = array("safe" => True);

								// insert the new document
  								$collection->insert($item,$options);
// end users loop
			}

// select a record/records from MySql table
			$result4 = mysql_query("SELECT * FROM mile");
			while($row = mysql_fetch_array($result4))
			{

			// store rows to variables
			$id = $row['id'];
			$fuserid = $row['userid'];

	$fldate = $row['ldate'];
                  $flyear = substr($fldate,0,4);
                  $flmonth = substr($fldate,5,2);
                  $flday = substr($fldate,8,2);
                  $fldate = $flyear . $flmonth . $flday;

			$fstart = $row['start'];
			$fend = $row['end'];
			$ftot = $row['tot'];
			$fexpl = $row['expl'];


// define a new MONGO document with safe insert
// access collection
  								$collection = $db->mile;

  								$item = array(
                                                'userid' => $fuserid,
     								'ldate' => $fldate,
     								'start' => $fstart,
     								'end' => $fend,
     								'tot' => $ftot,
								'expl' => $fexpl,

								);
    
  								$options = array("safe" => True);

								// insert the new document
  								$collection->insert($item,$options);
// end mileage loop
			}
 


// close the MySql connection
mysql_close($con);
// disconnect from MONGO server
$conn->close();
echo 'Done';
 ?> 

</body></html>