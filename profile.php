<?php
$title = "Profile";
$highprofile = "w3-blue";
session_start();
require_once 'nav.php';
?>

<script type="text/javascript">
    function submit()
    {
        // alert("I am an alert box!");
         document.getElementById("txtuname").value = "<?php echo $row['userName']; ?>";
    document.getElementById("txtemail").value = "<?php echo $row['userEmail']; ?>";
     
    }
</script>

<?php

if(isset($_POST['btn-reset-pass']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
    $id = $_SESSION['userSession'];
    //$uid = trim($_POST['userSession']);
	$code = md5(uniqid(rand()));
	
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0 ) {
        $msg = "
        <div class='alert'>
        <strong>Sorry !</strong>  Email allready exists, please try another one.
        </div>";
        
	   } else {
            $pass = $_POST['txtpass'];
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
		if($user_home->update($uname,$email,$upass,$id))
		{					
			$msg = "
					<div class='alert2'>
						<strong>Success!</strong>
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
            }
    }
}
?>

<link href="css/settings.css" rel="stylesheet" media="screen">
    <div class="container">
        <form class="form-signin" method="post">
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
       <div class="">
        <div class="login">
  <h2><?php echo $row['userName']; ?> - Profile</h2>
  <fieldset>
        Name: <input type="text" name="txtuname" id="txtuname" placeholder="Name" required />
        Email: <input type="email" name="txtemail" id="txtemail" placeholder="Email" required />
        New Password: <input type="password" name="txtpass" placeholder="New Password" required />
        Confirm New Password: <input type="password" name="confirm-pass" placeholder="Confirm New Password" required />
  </fieldset>
  <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Save changes</button>
 
        </div>
        </div>
      </form>

    </div> 


