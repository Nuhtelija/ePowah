<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Hi,
				   <br /><br />
				  You're receiving this email because you requested a password reset for your ePower Account. If you did not request this change, you can safely ignore this email.<br /><br />
                  To choose a new password and complete your request, please follow the link below:
				   <br /><br />
				   <a href='http://users.metropolia.fi/~juskam/epower/resetpass.php?id=$id&code=$code'>Click here to reset your password</a>
				   <br /><br />
				
				   ";
		$subject = "Password Reset";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert2'>
				
					We've sent an email to $email.
                    Please click on the reset link in the email to generate new password. 
			  	</div>";
        // header( "refresh:10;url=index.php" );
	}
	else
	{
		$msg = "<div class='alert'>
					<strong>Sorry!</strong>  Invalid email address. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  </head>
  <body id="login">
   <div class="topcontainer">
  <span class="w3-right">ePower</span>
</div>
  

      <form class="form-signin" method="post">
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
                
                <?php
			}
			?>
        
        <div class="login">
  <h2>Forgot Password</h2>
  <fieldset>
    <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
  </fieldset>
  <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
     <div class="utilities">
    <a href="index.php">&larr; Back</a>
  </div>
     
 </div> 
    </form>
  </body>
</html>