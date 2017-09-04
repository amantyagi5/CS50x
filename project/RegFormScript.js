function Submit(){
var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/; 
var birthdayRegex = /^(([0][1-9]|[1-2][0-9]|[3][0-1])[/]([0][1-9]|[1][0-2])[/]([1][9][5-9][0-9]|[2][0-1][0][0-5]))$/;  
var fname = document.form.Name.value;
var  lname = document.form.LastName.value;
var  email = document.form.Email.value;
var  address = document.form.Address.value;
var  phone = document.form.Phone.value;
var  password = document.form.Password.value;
var  birthday = document.form.Birthday.value;
var  username = document.form.Username.value;
var repassword = document.form.Re_Password.value;
 
 if( fname == "" )
   {
     document.form.Name.focus() ;
	 document.getElementById("errorBox").innerHTML = "enter the first name";
     return false;
   }
  
 if( lname == "" )
   {
     document.form.LastName.focus() ;
   document.getElementById("errorBox").innerHTML = "enter the last name";
     return false;
   }
   if (email == "" )
 {
  document.form.Email.focus();
  document.getElementById("errorBox").innerHTML = "enter the email";
  return false;
  }
  else if(!emailRegex.test(email)){
  document.form.Email.focus();
  document.getElementById("errorBox").innerHTML = "enter the valid email";
  return false;
  }
  if( address == "" )
   {
     document.form.Address.focus() ;
   document.getElementById("errorBox").innerHTML = "enter the address";
     return false;
   }
   if( phone == "" )
   {
     document.form.Phone.focus() ;
   document.getElementById("errorBox").innerHTML = "enter the last name";
     return false;
   }
  
 if(birthday == "")
  {
	  document.form.Birthday.focus();
	  document.getElementById("errorBox").innerHTML = "enter birthdate";
	  return false;
  }
  else if(!birthdayRegex.test(birthday))
  {
	  document.form.Birthday.focus();
  document.getElementById("errorBox").innerHTML = "enter the valid birthdate";
  return false;
  }
  if(document.form.sex[0].checked == false && document.form.sex[1].checked == false){
    document.getElementById("errorBox").innerHTML = "select your gender";
    return false;
   }
  
  if(username == "")
  {
   document.form.Username.focus();
   document.getElementById("errorBox").innerHTML = "enter the username";
   return false;
  }
  
  
    if(password == "")
  {
   document.form.Password.focus();
   document.getElementById("errorBox").innerHTML = "enter the password";
   document.form.Password.value="";
   document.form.Re_Password.value="";
   return false;
  }
    if(repassword == "")
  {
   document.form.Password.focus();
   document.getElementById("errorBox").innerHTML = "enter the password again";
document.form.Password.value="";    
document.form.Re_Password.value="";
   return false;
  }
  if(password != repassword)
  {
	   document.form.Password.focus();
	   document.getElementById("errorBox").innerHTML = "passwords do not match";
	   document.form.Password.value="";
	   document.form.Re_Password.value="";
	   return false;
  }  
  
  
  
  
  if(fname != '' && lname != '' && email != '' && address != '' && password != '' && birthday != '' && phone != '' && username != '' && repassword!='')
  {
   
   return true;
   }

}