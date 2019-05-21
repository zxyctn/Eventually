<?php
   include('session.php');
   $applied = $_SESSION['applied'];
   $sid = $_SESSION['sid'];
   
   if($applied == 3){
	   echo "You are not allowed to apply more than 3 companies";
   }
   else{
	   $sql0 = "SELECT cid  FROM `company`";
	   $result0 = mysqli_query($db,$sql0);
	   $myhashmap = array();
	   while($row0 = mysqli_fetch_array($result0))
	   {
		   $myhashmap[$row0['cid']] = 0;
	   }
	   
	   $sql1 = "SELECT cid, COUNT(*) as total FROM `apply` group by cid";
	   $result1 = mysqli_query($db,$sql1);
	   while($row1 = mysqli_fetch_array($result1))
	   {
		   $myhashmap[$row1['cid']] = $row1['total'];
	   }
	   
	   $sql2 = "SELECT * FROM `company` WHERE cid not in (select cid from apply where sid = '$sid')";
	   $result2 = mysqli_query($db,$sql2);

		echo "<table border='1'>
		<tr>
		<th>CID</th>
		<th>Company</th>
		<th>Quota</th>
		</tr>";

		while($row2 = mysqli_fetch_array($result2))
		{
			$tmpcid = $row2['cid'];
			$tmpcname = $row2['cname'];
			$tmpcorigquota = $row2['quota'];
			$tmprealquota = $tmpcorigquota - $myhashmap[$tmpcid];
			echo "<tr>";
			echo "<td>" . $tmpcid . "</td>";
			echo "<td>" . $tmpcname . "</td>";
			echo "<td>" . $tmprealquota . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		
		echo "Total number of applied companies: $applied";
		
		$_SESSION['sid'] = $sid;
	   
   }
?>

<html">
   
   <head>
      <title>Apply </title>
   </head>
   
	<body>
		<h2> </h2>
		<form action="apply.php" method="post">
		Company ID: <input type="text" name="cid"><br>
		<input type="submit">
		<input type="hidden" name="sid" value= <?php echo $sid; ?> >
		<input type="hidden" name="applied" value= <?php echo $applied; ?> >
		</form>
   </body>   

	<body>
      <h2><a href = "welcome.php">Go Back</a></h2>
   </body> 

	<body>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
</html>
