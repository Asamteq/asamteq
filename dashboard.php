<?php
	include("FILES/session.php");
	include("FILES/connection.php");
?>
<?php
	if(isset($_SESSION['user_id']))
	{

	}else{
		header("Location:login.php");
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
	<!--Navigation display on dashboard top-->

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
	<!--End of navigation tab--->
	
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-2" id="color">
		<!--creation of navbar-->
			<h2>Admin Area</h2>
			
			<ul class="nav nav-pills nav-stacked" id="main-menu">
				<li class="active">
				<a href="dashboard.php"><span class="glyphicon glyphicon-th"> 
				Dashboard</span></a></li>

				<li><a href="addPost.php">
				<span class="glyphicon glyphicon-list-alt">
				AddNewPost</span></a></li>

				<li><a href="category.php">
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

				<li><a href="logout.php">
				<span class="glyphicon glyphicon-log-out"> Logout
				</span></a></li>	
			</ul>
		</div>
		
		<h1>&nbsp;&nbsp;Admin Area</h1>
		<div><?php echo ErrorMessage(); 
					   echo SuccessMessage(); 
			?></div>
	<div class="col-md-8">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Post Title</th>
					<th>Date & Time</th>
					<th>Author</th>
					<th>Category</th>
					<th>Banner</th>
					<th>Comment</th>
					<th>Actions</th>
					<th>Detail</th>
				</tr>
<?php
	$conn;
	$view_data ="SELECT * FROM admin_panel ORDER BY dateTime DESC";
	$result=mysqli_query($conn,$view_data);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($result))
	{
		$serial_no++;
		$id 	  = $row['id'];
		$dateTime = $row['dateTime'];
		$title	  = $row['title'];
		$category = $row['category'];
		$author   = $row['author'];
		$image    = $row['image'];
		$post     = $row['post'];			
?>
		<tr>
			<td><?php echo $serial_no;?></td>
			<td>
			<?php  
				if(strlen($title)>5)
				{
					$title=substr($title,0,5);
				}
				echo $title."...";?>
			
			</td>
			<td>
			<?php 
				if(strlen($dateTime)>5)
				{
					$dateTime=substr($dateTime,0,5);
				}
				echo $dateTime."...";
				?>
			
			</td>
			<td>
			<?php 
				if(strlen($author)>5)
				{
					$author=substr($author,0,5);
				}
				echo $author."...";
			?>
			
			</td>
			<td>
			<?php 
				if(strlen($category)>5)
				{
					$category=substr($category,0,5);
				}
			
			echo $category."..";?>
			</td>
			<td><img src="upload/<?php echo $image; ?>" height="40px" width="80px"></td>
			<td>Processing</td>
			<td>
			<a href="editPost.php?edit=<?php echo $id; ?>">
			<span class="btn btn-warning btn-sm">Edit
			</span></a> 
			
			<a href="deletePost.php?delete=<?php echo $id; ?>">
			<span class="btn btn-danger btn-sm">Delete
			</span></a>
			</td>
			
			<td>
			<a href="fullPost.php?post_id=<?php echo $id;?>">
			<span class="btn btn-primary">Live Preview
			</span>
			</a>
			</td>
		</tr>


<?php
	}
?>	
			</table>
		</div>
	</div><!--end of coloumn 8-->
</body>
</html>