function Submit()
{
	 var username=document.form.username.value;
	 var password=document.form.password.value;
	 
	 if(username=="")
	 {
		 document.form.username.focus();
		 document.getElementById("errorBox").innerHTML="enter valid username" ;
		 return false;
		 }
   if(password=="")
   {
	   document.form.password.focus();
	   document.getElementById("errorBox").innerHTML="enter valid password";
	   return false;
   }
		 
		 
		 
		 
		 }