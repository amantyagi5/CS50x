<?php

if(isset($_POST['submit']))
{
	session_start();
	if(isset($_SESSION['userid']))
	session_unset($_SESSION['userid']);
  
if(isset($_SESSION['train_no']))
	session_unset($_SESSION['train_no']);

	header('Location: Home.html');
	
}
else echo"error";


?>