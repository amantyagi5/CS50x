<?php

if(isset($_POST['submit']))
{echo 'in';
	session_start();
mysql_connect('localhost','root','');
mysql_select_db('orrs');
$userid=$_SESSION['userid'];
$ticketid=$_SESSION['ticketid'];
$result=mysql_query("SELECT firstname,lastname from passenger_details where id='$userid'");
	$names=mysql_fetch_assoc($result);
	$fname=$names['firstname'];
     $lname=$names['lastname'];
	$welcome='WELCOME '.$fname.' '.$lname;

$result=mysql_query("SELECT * FROM booked_tickets where ticketid='$ticketid'");
$cancelled=mysql_fetch_assoc($result);
$trainno=$cancelled['train_number'];
$seat_number=$cancelled['seat_number'];
$waiting=$cancelled['waiting'];
mysql_query("DELETE FROM  booked_tickets where ticketid='$ticketid'");
if($waiting==0)
{
	mysql_query("UPDATE booked_tickets SET seat_number='$seat_number',waiting='0' where waiting='1' AND train_number='$trainno' ");
	mysql_query("UPDATE booked_tickets SET waiting=waiting-1 where train_number='$trainno' AND waiting>'0' ");
	
}
else
{
	mysql_query("UPDATE booked_tickets SET waiting=waiting-1 where waiting>'$waiting' AND train_number='$trainno' ");
}	
$result=mysql_query("SELECT * FROM train where train_number='$trainno'");
$train=mysql_fetch_assoc($result);
$booked=$train['booked'];
$trainwaitingno=$train['waiting'];
if($waiting==0)              //confirmed ticket cancelled
{
	if($trainwaitingno>0)             //train has passengers in waiting list so 1 passenger will be confirmed .so waiting--
	{
		mysql_query("UPDATE train SET waiting=waiting-1 where train_number='$trainno'");
		
	}
	else                                  //train has no waiting list so 1 extra seat becomes available        
	{
		mysql_query("UPDATE train SET booked=booked-1 where train_number='$trainno'");
	}
}
else                      //waiting ticket cancelled
{
	mysql_query("UPDATE train SET waiting=waiting-1 where train_number='$trainno'");
	
}
	
	
}

?>
<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="CancelNotif.css" />

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


  <div id="notif">
  
  <center>Ticket Cancelled</center>
  </div>
  <br><br><br>
  <div>
  <form action="Cancel.html">
  <center><input type="submit" name="submit" id="statussubmit" value="Cancel More"></center>
 </form>
 <br><br><br>
  <form action="UserAccount.php">
  <center><input type="submit" name="submit" id="homesubmit" value="Home"></center>
 </form>
 </div>
	  
</body>

</html>

