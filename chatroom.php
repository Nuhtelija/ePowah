<!DOCTYPE html>
<html>
<head>
    <title>ChatBox</title>
    <link rel="stylesheet" type="text/css" href="maini.css">
</head>

<body>
    <section></section>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="#">Home</a>
      <a href="#">Measure</a>
      <a href="#">Leaderboard</a>
      <a href="#">Social</a>
      <a href="#">Profile</a>
    </div>

    <div id="main">
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
    </div>

    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }
    </script>

    </body>

<?php
session_start();
 ?>
<script>

function getText() {

	var $a =	document.getElementById('text').value;

		xhr = new XMLHttpRequest();
		xhr.open('POST' , 'chatdb.php',true);
		xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
		xhr.send('chat='+$a);
		xhr.onreadystatechange=function(){
			if (xhr.responseText){
			//	document.getElementById('chatarea').innerHTML=xhr.responseText;
									}
				}
					}


function setText(){

	xhr = new XMLHttpRequest();
	xhr.open('POST' , 'chatFetch.php' , true);
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	xhr.send();
	xhr.onreadystatechange = function(){
	//	alert(xhr.responseText);
			document.getElementById('chatarea').innerHTML = xhr.responseText;
			}

	}
	setInterval("setText()",2000);


setInterval("users()",3000);


	function users(){
	xhr1 = new XMLHttpRequest();
	xhr1.open('POST' , 'userFetch.php' , true);
	xhr1.setRequestHeader('content-type','application/x-www-form-urlencoded');
	xhr1.send();
	xhr1.onreadystatechange = function(){
	//	alert(xhr.responseText);
			document.getElementById('loginperson').innerHTML = xhr1.responseText;
			}


		}


</script>
<?php

include_once('config.php');
				//	echo		$_SESSION['email'];
				//	echo	$_SESSION['password'];
			echo	$_SESSION['name'];




if (isset($_GET['logout'])){
	$result = mysqli_query($conn, "UPDATE user
SET user_status = '0'
WHERE user_email = '$_SESSION[email]';");
session_destroy();
header('location: practice.php?logout_successfully=<span style="color:green">You have successfully Logged Out.</span>');

	}

?>
<form action="">
<input type="submit" name="logout" value="logout">
</form>
<div id="chatbox">

<div id ="chatarea">
</div>

<div id="loginperson">
</div>

<div id="textbox">
<form>
<textarea rows="4" cols="100" id="text"></textarea>
<input type="button" value="send"  onclick="getText()" />
</form>
</div></center>

</div>

<?php
	if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
		//session_destroy();
		header('location: practice.php');
		}

 ?>

 </html>

