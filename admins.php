<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");
?>
<?php	
	if(isset($_POST['press']))
	{
		$username =mysqli_real_escape_string($conn,$_POST['username']);
		$password =mysqli_real_escape_string($conn,$_POST['password']);
		$confirm_password =mysqli_real_escape_string($conn,$_POST['confirm_password']);
		date_default_timezone_set("Asia/Karachi");
		$time=time();
	    $real_time=strftime("%B-%d-%Y %H:%M:%S",$time);
		$admin="Walli Rashid";
		if(empty($username) OR empty($password) OR empty($confirm_password) )
		{
			$_SESSION['error']="Please Fill all the fields";
		}
		else if(strlen($password)<8)
		{
			$_SESSION['error']="Please type at least 8 characters for password";
		}
		else if($password!==$confirm_password)
		{
			$_SESSION['error']="Your password does not match Retype the same password";
		}	
		else{
			$query ="INSERT INTO admins(dateTime,username,password,createdby)
			VALUES('$real_time','$username','$password','$admin')";
			global $conn;
			$execute=mysqli_query($conn,$query);
			if($execute)
			{
				$_SESSION['success']="Admins Added Successfully";
			}else{
				$_SESSION['error']="Admins is not added successfully";
			}
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

	<ul class="nav navbar-nav" id="navigation-collpase">
		<li><a href="">Home</a></li>
		<li><a href="blog.php" target="_blank">Blog</a></li>
		<li><a href="">About</a></li>
		<li><a href="">Services</a></li>
		<li><a href="">Contact Us</a></li>
		<li><a href="">Feature</a></li>
	</ul>
	<form action="blog.php" class="navbar-form" method="GET">
	
	<div class="form-group">
		<input type="text" name="search" class="form-controls"
		placeholder="Search Anything" style="padding:3px;">
		
		<input type="submit" name="search_data"
		class="btn btn-primary" value="Search">
		
	</div>
	</form>
</div>
</nav>	
<div class="line" style="height:10px;
	background-color:#0275d8;"></div>





	<div class="container-fluid">
	<div class="row">
		<div class="col-md-2" id="color">
			<h2>Admin Area</h2>
			<ul class="nav nav-pills nav-stacked" id="main-menu">
				<li ><a href="dashboard.php">
				<span class="glyphicon glyphicon-th"> Dashboard</span></a></li>
				<li><a href="addPost.php">
				<span class="glyphicon glyphicon-list-alt">
				AddNewPost</span></a></li>
				<li ><a href="category.php">
				<span class="glyphicon glyphicon-tags">
				 Categories</span></a></li>
				<li class="active"><a href="admins.php">
				<span class="glyphicon glyphicon-user"> ManageAdmins
				</span></a></li>
				<li><a href="comments.php">
				<span class="glyphicon glyphicon-comment"> Comments
				</span></a></li>
				<li><a href="">
				<span class="glyphicon glyphicon-equalizer"> LiveBlog
				</span></a></li>
				<li><a href="">
				<span class="glyphicon glyphicon-log-out"> Logout
				</span></a></li>
			</ul>
		
		</div>
		<div class="col-md-8">
		<form action="admins.php" method="post">
			<h2>Manage Admins</h2>
			<div><?php echo ErrorMessage(); 
					   echo SuccessMessage(); 
			?></div>
			<div class="form-group">
				<label>Username:</label>
				<input type="text" class="form-control" name="username" placeholder="Enter username"><br>


				<label>Password:</label>
				<input type="password" class="form-control" name="password" placeholder="Enter the password"><br>
		

				<label>Confirm Password</label>
				<input type="password" class="form-control" name="confirm_password" placeholder="Retype Password"><br>
				<input type="submit" class="btn btn-success btn-block" name="press" value="Register">
			</div>
		</form><br><br>
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
		<thead>
			<th>Id</th>
			<th>Date & Time</th>
			<th>Username</th>
			<th>Admins</th>
			<th>Action</th>
		<thead>
		<tbody>
			<?php
				$query="SELECT * FROM admins ORDER BY dateTime DESC";
				$sql=mysqli_query($conn,$query);
				$series_no=0;
				while($row=mysqli_fetch_assoc($sql))
				{
					$series_no=$series_no+1;
					?>
			<tr>
				<td><?php echo $series_no; ?></td>
				<td><?php echo $row['dateTime']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['createdby']; ?></td>	
				<td><a href="delete_admin.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
			</tr>					
			<?php				
					
				}							
			?>	
		</tbody>
		</table>
		</div>
	</div>
	</div><!--end of row tag-->
</div><!--end of container fluid-->	
</body>
</html>