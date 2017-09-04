<html>
<?php

session_start();

if(isset($_SESSION['userid']))
{
	mysql_connect('localhost','root','');
	mysql_select_db('orrs');
	$userid=$_SESSION['userid'];
	$result=mysql_query("SELECT firstname,lastname from passenger_details where id='$userid'");
	$names=mysql_fetch_assoc($result);
	$fname=$names['firstname'];
     $lname=$names['lastname'];
	$welcome='WELCOME '.$fname.' '.$lname;
}
else echo 'no user sesion';
?>


<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="UserAccount.css" />
<script type="text/javascript" src="SearchFormScript.js"></script>
</head>

<body>
<div id="title"><img src="title.jpg" alt="title" width="100%" height="250px"></div>
<div id="header">
<div id="welcome"  >  <?php echo $welcome; ?></div>
 <div id="button">
<form name="logout" action="Logout.php" method="POST">
	   <input type="submit" name="submit" id="logout" value="LogOut">
	   </form></div>
	   
</div>
<div id="container">
<div id="container1">
      <center><h1>TrainSearch</h1></center>
	  <div id="form">
	  <div id="errorBox"></div>
	  <form name="form" onSubmit="return Submit()" action="SearchTrain.php" method="POST">
	   Enter Source:
	  <div id="source_form">
	      <input type="text" name="source" value="" class="input_source" >
	  </div>
	  Enter Destination:
	  <div id="destination_form">
	     <input type="text" name="destination" value="" class="input_destination" >
	  </div>
	  Select Date:
        <div id="date_form">
             <input type="date" name="date" value="" class="input_date" >
        </div>	
      <div>
        <center><input type="submit" id="search_train" name="submit" value="Search"></center>
		
      </div>	
	  </form>
    </div>
</div>

<div id="container2">
     <form name="checkstatus" action="CheckStatus.html">
	   <center><input type="submit" name="check_status" id="check_status" value="Check Status"></center>
	   </form>
      <br><br>
	  <form name="cancel" action="Cancel.html">
	   <center><input type="submit" name="cancel" id="cancel" value="Cancel"></center>
	   </form>
      
	 </div>	  
	 </div>
 
</body>
</html>	  