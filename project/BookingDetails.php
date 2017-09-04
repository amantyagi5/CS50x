<?php
session_start();

	if(!isset($_SESSION['userid']))
		header('Location: SignIn.html');
	
	else
	{mysql_connect('localhost','root','');
	mysql_select_db('orrs');
	if(!isset($_SESSION['userid']))
		echo 'error';
	else $userid=$_SESSION['userid'];
	$result=mysql_query("SELECT firstname,lastname from passenger_details where id='$userid'") or die(err1);
	$names=mysql_fetch_assoc($result);
	$fname=$names['firstname'];
     $lname=$names['lastname'];
		
		$welcome='WELCOME '.$fname.' '.$lname;
		
		
		
	}



?>


<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="BookingDetails.css" />
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


	 <form name="count" onSubmit="return checkFields()" action="BookTickets.php" method="POST">
	<div id="container1">
 
	  <div id="form">
	  <div id="errorBox"></div>
	 
	   Enter no of passengers
	  <div id="count_form">
	      <input type="text" name="count" id="count" value="" class="input_count" >
	  </div>
	 
	  <div>
        <center><input type="button" onclick="createFields()" id="enter" name="enter" value="Enter"></center>
		
      </div>	

</div>
</div>
	
	<br>
	
	  <div id="fields">
	  <div id="errorBox1"></div>
	  </div>	
	 <div id="container3">
	 <center><input type="submit" value="Book" id="book" name="submit"></center></div>
	  </form>
	
	



</body>
</html>	  