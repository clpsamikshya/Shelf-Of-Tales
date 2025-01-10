function validateform(){
					var Full_Name     = document.forms["myform"]["fname"].value;
					var Email 		  = document.forms["myform"]["email"].value;
					var Mobile_Number = document.forms["myform"]["mobile"].value;
					var Message       = document.forms["myform"]["message"].value;


						if(Full_Name == "" || Email == "" || Mobile_Number == "" || Message == "" )
						{
							alert("Please fill all the field.");
						}
						else
						{
							alert("Thank you for your feedback!");
						}
				}
			