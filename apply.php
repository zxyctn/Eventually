<?php
	include('session.php');
	$cid = $_POST['cid'];
	$sid = $_POST['sid'];
	$applied = $_POST['applied'];
	// Check connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}
	
	$sql0 = "SELECT cid  FROM `company`";
	$result0 = mysqli_query($db,$sql0);
	$myarray = array();
	while($row0 = mysqli_fetch_array($result0))
	{
		$myarray[$row0['cid']] = $row0['cid'];
	}

	if (!array_key_exists($cid, $myarray)) {
		echo "Company ID does not exist in the system";
	}
	else{
		
		if($applied == 3){
		   echo "You are not allowed to apply more than 3 companies";
	   }
	   else{
		
			$sql = "INSERT INTO  apply (cid , sid) values ('$cid', '$sid')";

			if ($db->query($sql) === TRUE) {
				echo "You applied successfully";
			} else {
				echo "Error while applying: " . $db->error;
			}
		}
	}

	$_SESSION['login_user'] = $sid; 

?>

<html">
   <body>
      <h2><a href = "welcome.php">Go Back</a></h2>
   </body> 

	<body>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
</html>
