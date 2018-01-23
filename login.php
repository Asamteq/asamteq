<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");	
	require_once("FILES/functions.php");
	if(isset($_POST['press']))
	{
		$username =mysqli_real_escape_string($conn,$_POST['username']);
		$password =mysqli_real_escape_string($conn,$_POST['password']);
		if(empty($username) OR empty($password))
		{
			$_SESSION['error']="Please Fill all the fields";
		}	
			$sql ="SELECT * FROM admins WHERE username='$username' AND password='$password'";
			$execute=mysqli_query($conn,$sql);
			$fetch_data=mysqli_fetch_assoc($execute);
			$count=mysqli_num_rows($execute);
			if($count>0)
			{
				$_SESSION['user_id']=$fetch_data['id'];
				$_SESSION['username']=$fetch_data['username'];
				$_SESSION['success']="Congratulation Your Login!!!".$_SESSION['username'];
				header("Location:dashboard.php");
			}else{
				$_SESSION['error']="Invalid username and password";

			}
	}	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>CMS PHP</title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<script src="js/jquery.js" type="text/JavaScript"></script>
	<script src="js/bootstrap.js" type="text/JavaScript"></script>
</head>
<body>
	<div class="line" style="height:10px;
	background-color:#0275d8;"></div>
<nav class="nav navbar-inverse nav-color">
<div class="container">
	<div class="navbar-header" >
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-collpase">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a href="blog.php" class="navbar-brand" style="color:#fff;">Content Management System.Com </a>
	</div>

		
	</div>
	</form>
</div>
</nav>	
<div class="line" style="height:10px;
	background-color:#0275d8;"></div>
	<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-offset-4 col-md-4">
			<br><br>
		<form action="login.php" method="post">
			<h2>Welcome Back!!</h2>
			<br>
			<div><?php echo ErrorMessage(); 
					   echo SuccessMessage(); 
			?></div>
			<div class="form-group">
				<label>Username:</label>
				<input type="text" class="form-control" name="username" placeholder="Enter username"><br>


				<label>Password:</label>
				<input type="password" class="form-control" name="password" placeholder="Enter the password"><br>
				<input type="submit" class="btn btn-info btn-block" name="press" value="Register">
			</div>
		</form><br><br>

	</div>
	</div><!--end of row tag-->
</div><!--end of container fluid-->	
</body>
</html>