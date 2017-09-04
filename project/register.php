<?php
if(isset($_POST['submit']))
{
	
session_start();

$fname=$_POST['Name'];
$lname=$_POST['LastName'];
$email=$_POST['Email'];
$address=$_POST['Address'];
$phone=$_POST['Phone'];
$birthday=$_POST['Birthday'];
$sex=$_POST['sex'];
$username=$_POST['Username'];
$password=$_POST['Password'];

$conn=mysql_connect('localhost','root','');
mysql_select_db('orrs');

mysql_query("INSERT INTO login VALUES('NULL','$username','$password')");
$insertid=mysql_insert_id();

$_SESSION['userid']=$insertid;

mysql_query("INSERT INTO passenger_details VALUES('$insertid','$fname','$lname','$email','$address','$phone','$birthday','$sex')");

header('Location: UserAccount.php');
}


?>
