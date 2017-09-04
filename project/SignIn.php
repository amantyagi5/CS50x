<?php


if(isset($_POST['submit']))
{
	session_start();
	
$username=$_POST['username'];
$password=$_POST['password'];

mysql_connect('localhost','root','');
mysql_select_db('orrs');

$result=mysql_query("SELECT id FROM login where BINARY username='$username' AND BINARY password='$password'");

$return=mysql_num_rows($result);
$id=mysql_fetch_assoc($result);
if($return == 1 ){
           $_SESSION['userid']=$id['id'];
 	 if(isset($_SESSION['train_no']))
	  header('Location:BookingDetails.php');
	
	else
		header('Location: UserAccount.php');
       }
else 
{
	header('Location: wrongdetails.html');
}
}


   ?>