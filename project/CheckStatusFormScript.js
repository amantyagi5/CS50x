function Submit()
{
	 var id=document.form.ticket_id.value;
	 
	 if(id == "")
	 {    document.form.ticket_id.focus();
		 document.getElementById("errorBox").innerHTML="enter valid ticket id";
		 return false;
	 }
}