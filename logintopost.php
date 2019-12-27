<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

if (isset($_POST["Submit"])) {
$username=mysqli_real_escape_string($conn,$_POST["username"]);
$password=mysqli_real_escape_string($conn,$_POST["password"]);





 if (empty($username)||empty($password)) {

     $_SESSION["ErrorMessage"]="All must be filled";
      Redirect_to("logintopost.php");

 }

 else
	{
		$query="SELECT * FROM registration WHERE username='$username' AND password='$password'";
		$exec_query=mysqli_query($conn,$query);
		$s=mysqli_num_rows($exec_query);
		if($s>=1)
		{
			session_start();
			
			Redirect_to("Dashboard.php");
		}
		else
		{
		
            Redirect_to("logintopost.php");
		}
		$_SESSION['username']=$username;
	}



 }
 
 

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Login System</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	body {
		color: #fff;
		background: #3598dc;
	}
	.form-control {
		min-height: 41px;
		background: #f2f2f2;
		box-shadow: none !important;
		border: transparent;
	}
	.form-control:focus {
		background: #e2e2e2;
	}
	.form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 350px;
		margin: 30px auto;
		text-align: center;
	}
	.login-form h2 {
        margin: 10px 0 25px;
    }
    .login-form form {
		color: #7a7a7a;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #fff;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #3598dc;
		border: none;
        outline: none !important;
    }
	.login-form .btn:hover, .login-form .btn:focus {
		background: #2389cd;
	}
	.login-form a {
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover {
		text-decoration: none;
	}
	.login-form form a {
		color: #7a7a7a;
		text-decoration: none;
	}
	.login-form form a:hover {
		text-decoration: underline;
	}
</style>
</head>
<body>
<div class="login-form">
    <form action="logintopost.php" method="post">
        <img src="img/brand.png">   
        <div class="form-group has-error">
        	<input type="text" class="form-control" name="username" placeholder="Username" >
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" >
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="Submit">Sign in</button>
        </div>
        
    </form>
    <div ><?php echo Message(); 
             echo SuccessMessage();
             ?></div>
    
</div>
</body>
</html> 





