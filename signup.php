<!DOCTYPE html>
<html>

<head>
   <title>ePower</title>
    <link rel="stylesheet" href="styles.css">
    <script>
function getcity(id) {
			xhr = new XMLHttpRequest();
			xhr.open('GET' , 'test.php?idd='+id, true);
			xhr.send();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status==200){
					document.getElementById("city_display").innerHTML = xhr.responseText;
					}

				}


}

function getEmail(emailid){

			email  = new XMLHttpRequest();
			email.open('GET' , 'test2.php?email='+emailid, true);
			email.send();
			email.onreadystatechange = function(){
				if (email.readyState == 4 && email.status == 200)
				{

					document.getElementById('emailDiv').innerHTML = email.responseText;
					}

				}


	}


	function password (pass){
	var a =	document.getElementById('pass1').value;
	//	document.write(a);
		var b = document.getElementById('pass2').value;
		if (a == b ){
			document.getElementById('cnfrmpass').innerHTML = "<font color='#00CC00'>Matched</font>";
			}
			else {

				document.getElementById('cnfrmpass').innerHTML = "<font color='red'>Miss matched</font>";
				}
		}

</script>
</head>
<body>
    <form method="post" action="insert.php">
    <div class="login">
        <h1>ePower</h1>

           <input type="text" name="name" placeholder="Name" required="required" />
            <input type="email" name="email" placeholder="Email" onBlur="getEmail(this.value)" />
            <input type="password" name="pass1" placeholder="Password" required="required" />
              <input type="password" name="pass2" placeholder="Repeat password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large sbt">Sign Up</button>

    </div>
    </form>
</body>
</html>


