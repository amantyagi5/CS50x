<?php

session_start();
mysql_connect('localhost','root','');
mysql_select_db('orrs');
$userid=$_SESSION['userid'];
if(isset($_POST['ticket_id']))
	$ticketid=$_POST['ticket_id'];
else echo 'error';

$result=mysql_query("SELECT firstname,lastname from passenger_details where id='$userid'");
	$names=mysql_fetch_assoc($result);
	$fname=$names['firstname'];
     $lname=$names['lastname'];
	$welcome='WELCOME '.$fname.' '.$lname;
$result=mysql_query("SELECT username from login WHERE id='$userid'");
$result=mysql_fetch_assoc($result);
$username=$result['username'];
$result=mysql_query("SELECT * FROM booked_tickets where passenger_id='$userid' AND ticketid='$ticketid'");



?>
<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="TicketStatus.css" />
<script type="text/javascript" src="SearchFormScript.js"></script>
</head>

<body>
<div id="title"><img src="title.jpg" alt="title" width="100%" height="250px"></div>
<div id="header">
<div id="welcome"  >  <?php echo $welcome; ?></div>
<div id="button">
<form name="logout" action="LogOut.php" method="POST">
	   <center><input type="submit" name="submit" id="logout" value="LogOut"></center>
	   </form>
 </div>
 </div>

<?php
  if(mysql_num_rows($result)==0)
  { ?>
  <div id="error">
  
  <center>Invalid Ticked Id</center></div>
  <br><br><br>
  <form action="Cancel.html" method="POST">
  <center><input type="submit" name="submit" id="statussubmit" value="Try Again!"></center>
 </form>
 <br><br><br>
  <form action="UserAccount.php" method="POST">
  <center><input type="submit" name="submit" id="homesubmit" value="Home"></center>
 </form>
 
	  
	<?php }
	
	else {
		$ticketinfo=mysql_fetch_assoc($result);
		
		$trainno=$ticketinfo['train_number'];
		$seatno=$ticketinfo['seat_number'];
		$passengername=$ticketinfo['passengername'];
		
		$waiting=$ticketinfo['waiting'];
		if($seatno==0)
			$seatno='-';
		$result=mysql_query("SELECT name,source,destination from train where train_number='$trainno'");
		$train=mysql_fetch_assoc($result);
		$trainname=$train['name'];
		$source=$train['source'];
		$destination=$train['destination'];
		$_SESSION['ticketid']=$ticketid;
		?>
	

<div id="container1">
      <center><h1>Ticket Status</h1></center>
	  <div id="info">
	  Ticket ID:<?php echo $ticketid; ?> &nbsp;&nbsp;&nbsp;&nbsp; BookingUserName:<?php echo $username; ?> <br>
       </div>
      <div id="info">
       Train No:<?php echo $trainno; ?> &nbsp;&nbsp;&nbsp; Train: <?php echo $trainname; ?> <br>
	   </div>
      <div id="info">
	   Source: <?php echo $source; ?> &nbsp;&nbsp;&nbsp; Destination:<?php echo $destination;?><br>
       </div>
       	 <div id="info">
      Passenger:<?php 	echo $passengername;?> &nbsp;&nbsp;&nbsp; Status:<?php if($waiting==0) echo 'Confirmed &nbsp;&nbsp;&nbsp;  Seat No:'.$seatno; else echo 'Waiting &nbsp;&nbsp;&nbsp; Waiting:'.$waiting; ?> <br>
       </div>
	   <div>
   <form action="Cancel.php" method="POST">
     <center><input type="submit" name="submit" id="home" value="Cancel"></center></form>	
	  
	  
	  </div>
    </div>

	<?php } ?>

</body>
</html>	  
