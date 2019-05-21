<?php
   include('session.php');
   $sid = $_SESSION['login_user'];
   
   //flag 1 ya da 2 ise delete.php den geldik.
   // 1 successful 2 not successful
   // bunlar dan biriyse de 0 göndererek tekrar bu sayfayı refresh
   
   
   $sql1 = "SELECT sname FROM student WHERE sid = '$sid'";
   $result1 = mysqli_query($db,$sql1);
   $resultarr1 = mysqli_fetch_array($result1);
   $sname = $resultarr1[0];
   
   
   $sql2 = "SELECT cid, COUNT(*) as total FROM `apply` group by cid";
   $result2 = mysqli_query($db,$sql2);
   $myhashmap = array();
   while($row1 = mysqli_fetch_array($result2))
   {
	   $myhashmap[$row1['cid']] = $row1['total'];
   }
 
   
   $sql3 = "SELECT * FROM `company` WHERE cid in (select cid from apply where sid = '$sid')";
   $result3 = mysqli_query($db,$sql3);

	echo "<table border='1'>
	<tr>
	<th>CID</th>
	<th>Company</th>
	<th>Quota</th>
	<th></th>
	</tr>";
	
	$applied = 0;

	while($row2 = mysqli_fetch_array($result3))
	{
		$tmpcid = $row2['cid'];
		$tmpcname = $row2['cname'];
		$tmpcorigquota = $row2['quota'];
		$tmprealquota = $tmpcorigquota - $myhashmap[$tmpcid];
		echo "<tr>";
		echo "<td>" . $tmpcid . "</td>";
		echo "<td>" . $tmpcname . "</td>";
		echo "<td>" . $tmprealquota . "</td>";
		echo "<td><a href='delete.php?cid=".$tmpcid."&sid=".$sid."'>Cancel</a></td>";
		echo "</tr>";
		$applied = $applied + 1;
	}
	echo "</table>";
	
	echo "Total number of applied companies: $applied";
	
	$_SESSION['applied'] = $applied;
	$_SESSION['sid'] = $sid;
?>

<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $sname; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body> 

	<body>
      <h2><a href = "application.php">apply for new internship</a></h2>
   </body>    
</html>
