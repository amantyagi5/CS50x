



<?php

if(isset($_POST['submit']))
{
	session_start();
	
	$userid=$_SESSION['userid'];
	$train_no=$_SESSION['train_no'];
	$count=$_POST['count'];
	mysql_connect('localhost','root','');
	mysql_select_db('orrs');
	$result=mysql_query("SELECT username from login WHERE id='$userid'");
$result=mysql_fetch_assoc($result);
$username=$result['username'];
$result=mysql_query("SELECT firstname,lastname from passenger_details where id='$userid'");
	$names=mysql_fetch_assoc($result);
	$fname=$names['firstname'];
     $lname=$names['lastname'];
	$welcome='WELCOME '.$fname.' '.$lname;
	$result=mysql_query("SELECT name,source,destination,capacity,booked,waiting FROM train WHERE train_number ='$train_no'");
	$seats=mysql_fetch_assoc($result);
	$trainname=$seats['name'];
	$source=$seats['source'];
	$destination=$seats['destination'];
	$capacity=$seats['capacity'];
	$booked=$seats['booked'];
	$waiting=$seats['waiting'];
	mysql_query("CREATE TABLE temp SELECT seat_number as seat FROM booked_tickets WHERE train_number='$train_no' ORDER BY seat");
}
?>	
	
	
	
<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="BookTickets.css" />
<script type="text/javascript" src="BookingDetails.js"></script>
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
<div id="list">	
<?php	for($i=0;$i<$count;$i++)
	{  $name=$_POST["name".$i];
       $age=$_POST["age".$i];
	   $sex=$_POST["sex".$i];
	   $contact=$_POST["contact".$i];
     
        
		$ticketid = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
		$ticketid.= substr(str_shuffle("0123456789"), 0,4 );
		if($capacity-$booked>0)
		{   $booked++;
			$seatno;
			$result=mysql_query("SELECT seat FROM temp LIMIT 1");
          $result=mysql_fetch_assoc($result);
		  if($result['seat'] != 1)
		  {
			  $seatno=1;
		  }
		  else
		  {
			  
		  $result=mysql_query("SELECT t1.seat+1 AS Missing FROM temp AS t1 LEFT JOIN temp AS t2 ON t1.seat+1 = t2.seat WHERE t2.seat IS NULL ORDER BY t1.seat LIMIT 1"); 
          $result=mysql_fetch_assoc($result);
		  $seatno=$result['Missing'];
		  } mysql_query("INSERT INTO temp values('$seatno')");
			mysql_query("INSERT INTO booked_tickets values('$ticketid','$userid','$train_no','$seatno','$waiting','$name','$age','$contact','$sex')");
			
            mysql_query("UPDATE  train SET booked='$booked' where train_number='$train_no'");
		  ?>
			
			<div id="ticket">
			
			
	  <div id="info">
	  Ticket ID:<?php echo $ticketid; ?> &nbsp;&nbsp;&nbsp;&nbsp; BookingUserName:<?php echo $username; ?> <br>
       </div>
      <div id="info">
       Train No:<?php echo $train_no; ?> &nbsp;&nbsp;&nbsp; Train: <?php echo $trainname; ?><br>
       </div>
	   <div id="info">
	    Source: <?php echo $source; ?> &nbsp;&nbsp;&nbsp;&nbsp; Destination:<?php echo $destination;?><br>
		</div>
       	 <div id="info">
      Passenger:<?php 	echo $name;?> &nbsp;&nbsp;&nbsp; Status:<?php  echo 'Confirmed'; ?> &nbsp;&nbsp;&nbsp;  Seat No:<?php echo $seatno;?><br>
		</div>
       <div id="info">
      Age:<?php echo $age; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sex: <?php echo $sex; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact: <?php echo $contact; ?>	   
			
			</div>
			</div><br>
			
		<?php } 
		else
		{ 
			$seatno=0;
			$waiting++;
			mysql_query("INSERT INTO booked_tickets values ('$ticketid','$userid','$train_no','$seatno','$waiting','$name','$age','$contact','$sex')");
			mysql_query("UPDATE  train SET waiting='$waiting' where train_number='$train_no'") ;
			?>
			
			<div id="ticket">
			
	  <div id="info">
	  Ticket ID:<?php echo $ticketid; ?> &nbsp;&nbsp;&nbsp;&nbsp; BookingUserName:<?php echo $username; ?> <br>
       </div>
      <div id="info">
       Train No:<?php echo $train_no; ?> &nbsp;&nbsp;&nbsp;&nbsp; Train: <?php echo $trainname; ?> <br>
       </div>
	   <div id="info">
	    Source: <?php echo $source; ?> &nbsp;&nbsp;&nbsp; Destination:<?php echo $destination;?><br>
		</div>
       	 <div id="info">
      Passenger :<?php 	echo $name;?> &nbsp;&nbsp;&nbsp; Status:<?php echo 'Waiting' ?> &nbsp;&nbsp;&nbsp; Waiting: <?php echo $waiting; ?> <br>
		</div>
       <div id="info">
      Age:<?php echo $age; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sex: <?php echo $sex; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact: <?php echo $contact; ?>	  
			
			</div>
			</div><br>
			
	<?php	} 
		
	} mysql_query("DROP TABLE temp") ?>
	
	<form action="UserAccount.php">
	 <center><input type="submit" name="submit" id="home" value="Home"></center>
	</div>
	

	



</body>
</html>