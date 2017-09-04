function createFields()
{
	document.getElementById("errorBox").innerHTML="";
	var count=document.getElementById("count").value;
	if(count<=0)
	{
		document.getElementById("errorBox").innerHTML="enter valid no.";
		
	}
	
	else
	{ var container=document.getElementById("fields"),input;
		input=document.createElement('div');
		input.innerHTML="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Age &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sex &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Contact";
		var i;
		container.appendChild(input);  
		container.appendChild(document.createElement("br"));
                container.appendChild(document.createElement("br"));
               
		for (i=0;i<count;i++)
		{
			
                
                 input = document.createElement("input");
                input.type = "text";
                input.name = "name"+i;
				
				input.id="name"+i;
				input.class="field_input";
				input.value="";
                container.appendChild(input);
				input=document.createElement('div');
		        input.innerHTML="&nbsp&nbsp&nbsp&nb";
				 input = document.createElement("input");
                input.type = "text";
                input.name = "age" + i;
				input.id = "age" + i;
				input.class="field_input";
				input.value="";
                container.appendChild(input);
				
				 input = document.createElement("input");
                input.type = "text";
                input.name = "sex" + i;
				input.id = "sex" + i;
				input.class="field_input";
				input.value="";
                container.appendChild(input);
				
				 input = document.createElement("input");
                input.type = "text";
                input.name = "contact" + i;
				input.id = "contact" + i;
				
				input.class="field_input";
				input.value="";
                container.appendChild(input);
                
				container.appendChild(document.createElement("br"));
                container.appendChild(document.createElement("br"));
		}
		
	     document.getElementById("container3").style.display='inline-block';
	document.getElementById("fields").style.display='inline-block';
	
	}
	
	}
	
	function checkFields() {
	var count=document.getElementById("count").value;
   var i;
 for(i=0;i<count;i++)
 {    var x = document.getElementById("name"+i).value;
	 
	 if(x=="")
	 {
		document.getElementById("errorBox1").innerHTML="all details compulsary";
		 return false;
	 }
	  var x = document.getElementById("age"+i).value;
	 
	 if(x=="")
	 {
		document.getElementById("errorBox1").innerHTML="all details compulsary";
		 return false;
	 }
	  var x = document.getElementById("sex"+i).value;
	 
	 if(x=="")
	 {
		document.getElementById("errorBox1").innerHTML="all details compulsary";
		 return false;
	 }
	  var x = document.getElementById("contact"+i).value;
	 
	 if(x=="")
	 {
		document.getElementById("errorBox1").innerHTML="all details compulsary";
		 return false;
	 }
	 
	 
	 
	
	
	 
 }	 
		
	}