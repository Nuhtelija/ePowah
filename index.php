<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		$user_login->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
   <title>Login | ePower</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="css/style.css">
     
      

  
</head>

<body>
<div class="topcontainer" style="z-index:4">
  <span class="w3-right">ePower</span>
</div>
 <?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert'>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>
		<form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert'>
				<strong>Wrong Details!</strong> 
			</div>
            <?php
		}
		?>
		
  <div class="login">
  <h2>Log In</h2>
  <fieldset>
    <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
  	<input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
  </fieldset>
  <button class="btn btn-large btn-primary" type="submit" name="btn-login">Log in</button>
  
  <div class="utilities">
    <a href="fpass.php">Forgot Password?</a>
    <a href="signup.php">Sign Up &rarr;</a>
  </div>
</div>
 </form>
  
  
</body>
</html>
