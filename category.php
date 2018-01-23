<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");
?>
<?php	
	if(isset($_POST['press']))
	{
		$name =mysqli_real_escape_string($conn,$_POST['category']);
		date_default_timezone_set("Asia/Karachi");
		$time=time();
	    $real_time=strftime("%B-%d-%Y %H:%M:%S",$time);
		$admin=$_SESSION['username'];
		if(empty($name))
		{
			$_SESSION['error']="Please add category";
		}
		else if(strlen($name)>30)
		{
			$_SESSION['error']="Category size is too long";
		}else{
			$query ="INSERT INTO category(dateTime,name,creatorName)
			VALUES('$real_time','$name','$admin')";
			global $conn;
			$execute=mysqli_query($conn,$query);
			if($execute)
			{
				$_SESSION['success']="Category Added Successfully";
			}else{
				$_SESSION['error']="Category Does not added successfully";
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
				<li class="active"><a href="category.php">
				<span class="glyphicon glyphicon-tags">
				 Categories</span></a></li>
				<li><a href="admins.php">
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
		<form action="category.php" method="post">
			<h2>Manage Categories</h2>
			<div><?php echo ErrorMessage(); 
					   echo SuccessMessage(); 
			?></div>
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" name="category" placeholder="Enter the category"><br>
				<input type="submit" class="btn btn-success btn-block" name="press" value="submit">
			</div>
		</form><br><br>
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
		<thead>
			<th>Id</th>
			<th>Date & Time</th>
			<th>Name</th>
			<th>Creator Name</th>
		<thead>
		<tbody>
			<?php
				$query="SELECT * FROM category ORDER BY dateTime DESC";
				$sql=mysqli_query($conn,$query);
				$series_no=0;
				while($row=mysqli_fetch_assoc($sql))
				{
					$series_no=$series_no+1;
					?>
			<tr>
				<td><?php echo $series_no; ?></td>
				<td><?php echo $row['dateTime']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['creatorName']; ?></td>	
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