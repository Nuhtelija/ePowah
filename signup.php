<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert'>
				
					<strong>Sorry !</strong>  Email allready exists, please try another one.
			  </div>
			  ";
	}
	else
	{
        $pass = $_POST['txtpass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert'>
						
						<strong>Sorry!</strong>  Password doesn't match. 
						</div>";
            } else {
		if($reg_user->register($uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to ePower!<br /><br />
						To complete your registration click following link.<br/>
						<br /><br />
						<a href='http://users.metropolia.fi/~juskam/epower/verify.php?id=$id&code=$code'>Click here to activate</a>
						<br /><br />";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert'>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}	
	}
}
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
   <title>Sign up | ePower</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<div class="topcontainer" style="z-index:4">
  <span class="w3-right">ePower</span>
</div>

<?php if(isset($msg)) echo $msg;  ?>
  <div class="login">
  <form class="" method="post">
  <h2>Sign Up</h2>
  <fieldset>
        <input type="text" class="input-block-level" placeholder="Name" name="txtuname" required />
        <input type="email" class="input-block-level" placeholder="Email" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
        <input type="password" class="input-block-level" placeholder="Confirm Password" name="confirm-pass" required />
  </fieldset>
  <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
  
  <div class="utilities">
    <a href="index.php">&larr; Back</a>
  </div>
  </form>
</div>
  
  
</body>
</html>
