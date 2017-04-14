<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass) {
                $msg = "<div class='alert'>
						<strong>Sorry!</strong>  Password doesn't match. 
						</div>";
                } else {
                    if (strlen($pass) < 6) {
                        $msg = "<div class='alert'> <strong>Sorry!</strong>  Password too short! 
						</div>";
                    }  else {
                        if (!preg_match("#[0-9]+#", $pass)) {
                            $msg = "<div class='alert'>
						          <strong>Sorry!</strong>  Password must include at least one number! </div>";
                        } else {
                            if (!preg_match("#[a-zA-Z]+#", $pass)) {
                                $msg = "<div class='alert'>
						              <strong>Sorry!</strong>  Password must include at least one letter! </div>";
                            } else {
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert2'>

						Password Changed.
						</div>";
				header("refresh:5;index.php");
			}
                        }
                    }
            }
		}	
	}
	else
	{
		$msg = "<div class='alert'>
				No Account Found, Try again
				</div>";
				
	}
	
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  </head>
  <body id="login">
   <div class="topcontainer" style="z-index:4">
  <span class="w3-right">ePower</span>
</div>
   
    <div class="container">
        <form class="form-signin" method="post">
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
        <div class="login">
  <h2>Reset password</h2>
  <fieldset>
    <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />
     
        
  </fieldset>
  <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>
 
        </div>
      </form>

    </div> 
  </body>
</html>