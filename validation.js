
function validateForm(){


  var check=0;
  var error1=null,error2=null,error3=null,error4=null,error5=null,error6=null,error7=null;


	var fullname = document.getElementById("name").value;
	var name = document.getElementById("uname").value;
	var email = document.getElementById("email").value;
	var phno = document.getElementById("phone").value;
	var password = document.getElementById("pass").value;
	var cpassword = document.getElementById("cpass").value;

	//Check name

	if (!( /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/.test(fullname))) {
		error1=  'Name sholud contain only alphabets and space';
		check=1;
	}
	
	
	//Check Username

	if(!(/^\w+$/.test(name))) {
      error2 ="Username must contain only letters, numbers and underscores!";
      check=1;
    }


	//Check mail
	
	if(!(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.+[a-zA-Z]{2,4}$/.test(email))){
		error3 ="Invalid mail address";
	check=1;
	}


	//Check phone
	if(!(/\d/.test(phno))){
		error4 = "Phone must contain only digits";
		check=1;
			
	}
	if(phno.length !== 10){
		error4 = "Mobile number must contain 10 digits";
		check=1;
	}
	 
	
	
	//Check pass
	
	if(!(/\S/.test(password))){
		error5 = "Password must contain atleast 1 non-whitespace character, and must not be empty";
		check=1;
	}

	//Check Confirm Password
	if(password !== cpassword){
		error6= "Re-Enter the correct password";
		check=1;
	}   	
	//Check the pic
	if( document.getElementById("files").files.length == 0 ){
		error7 = "No files selected";
		check=1;
	}

	if(check==1)
	{
		document.getElementById('kalyan1').innerHTML = error1;
		document.getElementById('kalyan2').innerHTML = error2;
		document.getElementById('kalyan3').innerHTML = error3;
		document.getElementById('kalyan4').innerHTML = error4;
		document.getElementById('kalyan5').innerHTML = error5;
		document.getElementById('kalyan6').innerHTML = error6;
		document.getElementById('kalyan7').innerHTML = error7;
		check=2;
		return false;
	}
	else{
		return true;	
	}
}


document.getElementById('fields').addEventListener("submit",function(e){

    e.preventDefault();
    var f = e.target;
    var form1 = new FormData(f);
    var xhttp = new XMLHttpRequest();
	
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4  && xhttp.status == 200 ) {
				
				if (xhttp.responseText.search("kalyanaa")>=0) {
                alert("Successfully registered");
                window.location.href = 'login.php';
			}
            else
                document.getElementById("demo").innerHTML=xhttp.responseText;
        }
    };
    xhttp.open("POST", "validation.php", true);
    xhttp.send(form1);
});
