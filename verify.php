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
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $user->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
			$msg = "
		           <div class='alert'>
				    Your account is now activated : <a href='index.php'>Login here</a>
			       </div>
			       ";	
		}
		else
		{
			$msg = "
		           <div class='alert'>
					  <strong>Sorry !</strong>  Your Account is allready activated : <a href='index.php'>Login here</a>
			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert'>
			 
			   <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
			   </div>
			   ";
	}	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Confirm Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  </head>
  <body id="login">
   <div class="topcontainer" style="z-index:4">
  <span class="w3-right">ePower</span>
</div>
    <div class="container">
		<?php if(isset($msg)) { echo $msg; } ?>
    </div> 
  </body>
</html>