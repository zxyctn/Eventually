<?php
	include('session.php');
	$cid = $_GET['cid'];
	$sid = $_GET['sid'];
	// Check connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}

	// sql to delete a record
	$sql = "DELETE  FROM apply where cid = '$cid' and sid = '$sid'";

	if ($db->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $db->error;
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
