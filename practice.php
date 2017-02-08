<!DOCTYPE html>
<html>

<head>
   <title>ePower</title>
    <link rel="stylesheet" href="styles.css">
</head>



<body>
   <a href="signup.php" class="signin">Sign up</a>
   <form method="post" action="process.php">

    <div class="login">
        <h1>ePower</h1>
            <input type="text" name="email" placeholder="Email" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large loginbtn">Log In</button>
            <?php if( isset($_GET['registeration_successfull'])){ ?><?php echo $_GET['registeration_successfull']; ?>
<?php } ?>
           <p class="message"><a href="#">Forgot password?</a></p>

    </div>
<br /><br />


    </form>
</body>

</html>
