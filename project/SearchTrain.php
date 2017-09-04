<?php
session_start();
if(isset($_POST['submit']))
{
	$source=$_POST['source'];
	$destination=$_POST['destination'];
	
	mysql_connect('localhost','root','');
	mysql_select_db('orrs');
	
	$result=mysql_query("SELECT * from train where source='$source' AND destination='$destination'");
	
	$train=mysql_fetch_assoc($result);
	
	$train_no=$train['train_number'];
	$train_name=$train['name'];
	$available=$train['capacity']-$train['booked'];
	
		$waiting=$train['waiting'];
		 $_SESSION['train_no']=$train_no;
}  
	?>
	
	

<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="TrainTable.css" />



</head>

<body>
<div id="title"><img src="title.jpg" alt="title" width="100%" height="250px"></div>
<div id="welcome"  > <?php if (isset($_SESSION['user_id'])) {echo "WELCOME $fname $lname"; } ?></div>

<div id="container1">
    <table>
  <tr>
    <th>Train No.</th>
    <th>Train Name</th>
	<th>Availability</th>
	<th>AL/WL</th>
	<th>      </th>
  </tr>
  <tr>
    <td><?php echo $train_no?></td>
    <td><?php echo $train_name?></td>
	<td><?php if($available <= 0) echo "Waiting"; else echo "Available";?></td>
	<td><?php if($available <=0) echo $waiting; else echo $available;?></td>
	<td> <form method="POST" action="BookingDetails.php" ><input type="submit" name="submit" value="Book" id="book"></form></td>
  </tr>
  
</table>
</div>


  
</body>
</html>	  
	
	