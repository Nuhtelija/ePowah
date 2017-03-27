<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?php
$userMail = $_SESSION['email'];

$imageWidth = '150'; //The image size

$imgUrl = 'http://www.gravatar.com/avatar/'.md5($userMail).'fs='.$imageWidth;

?>

<!DOCTYPE html>
<html>
<head>
<title>ePower</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link href="css/settings.css" rel="stylesheet" media="screen">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<script>
function submit() {
    document.getElementById("txtuname").value = "<?php echo $row['userName']; ?>";
    document.getElementById("txtemail").value = "<?php echo $row['userEmail']; ?>";
}
</script>
</head>
<body onload="submit()" class="w3-light-grey">

<!-- Top container -->
<div class="w3-container w3-top w3-black w3-large w3-padding" style="z-index:4">
  <button class="w3-button w3-hide-large w3-padding-0 w3-black w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-right">ePower</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="<?php echo $imgUrl;?>" class="w3-circle w3-margin-right" style="width:70px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $row['userName']; ?></strong></span><br>
     
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home"></i>  Home</a>
    <a href="results.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-area-chart"></i>  Results</a>
    <a href="social.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-weixin"></i>  Social</a>
    <a href="profile.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user"></i>  Profile</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out"></i>  Logout</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
</div>
   
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
<!--  <?php echo $row['userName']; ?>
  <?php echo $row['userEmail']; ?>
  <p>Name:</p>
   <input type="text" class="input-block-level" placeholder="Name" name="txtuname" required />
       <p>Email:</p>
        <input type="email" class="input-block-level" placeholder="Email" name="txtemail" required />
        <p>Change password:</p>
    <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />-->
        Name: <input type="text" id="txtuname" placeholder="Name" required />
        Email: <input type="email" id="txtemail" placeholder="Email" required />
        New Password: <input type="password" id="pass" placeholder="New Password" required />
        Confirm New Password: <input type="password" id="pass" placeholder="Confirm New Password" required />
  
  </fieldset>
  <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Save changes</button>
 
        </div>
        </div>
      </form>

    </div> 

  <!-- End page content -->


<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
