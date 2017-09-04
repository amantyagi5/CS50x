function Submit(){
	
	var source = document.form.source.value;
	var destination = document.form.destination.value;
	
	if(source == "")
	{
		document.form.source.focus() ;
   document.getElementById("errorBox").innerHTML = "enter the source";
     return false;
	}
	
	if(destination == "")
	{
		document.form.destination.focus() ;
   document.getElementById("errorBox").innerHTML = "enter the destination";
     return false;
	}
	
}