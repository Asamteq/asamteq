<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");
?>
<?php	
	if(isset($_POST['press']))
	{
		$title =mysqli_real_escape_string($conn,$_POST['title']);
		$option = $_POST['category'];
		$comment =$_POST['comment'];
		$file_name =$_FILES['file_upload']['name'];
		$tmp_loc  =$_FILES['file_upload']['tmp_name'];
		$explode = explode(".",$file_name);
		$get_ext=$explode[1];
		$pic_ext = array("JPG","jpg","jpeg","JPEG","PNG","png","GIF","gif");
		$dir = "upload/".$file_name;
		date_default_timezone_set("Asia/Karachi");
		$time=time();
	    $real_time=strftime("%B-%d-%Y %H:%M:%S",$time);
		$admin=$_SESSION['username'];
		if(empty($title))
		{
			$_SESSION['error']="Please add title";
		}
		else if(strlen($title)>30)
		{
			$_SESSION['error']="Title is too long";
		}
		else{
			if(in_array($get_ext,$pic_ext))
			{	
			$query ="INSERT INTO admin_panel(dateTime,title,category,author,image,post)
			VALUES('$real_time','$title','$option','$admin','$file_name','$comment')";
			global $conn;
			$execute=mysqli_query($conn,$query);
			if($execute)
			{
				move_uploaded_file($tmp_loc,$dir);
				$_SESSION['success']="Your title has been added successfully";
			}else{
				$_SESSION['error']="Title is not added successfully";
			}
		}
		else{
			$_SESSION['error']="Please choose the correct image type";
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
				<li class="active"><a href="addPost.php">
				<span class="glyphicon glyphicon-list-alt">
				AddNewPost</span></a></li>
				<li ><a href="category.php">
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
		<form action="addPost.php" method="post" enctype="multipart/form-data">
			<h2>Add Post</h2>
			<div><?php echo ErrorMessage(); 
					   echo SuccessMessage(); 
			?></div>
			<div class="form-group">
				<label>Title:</label>
				<input type="text" class="form-control" name="title" placeholder="Title"><br>
				<label>Select Option:</label><select class="form-control" name="category">
				<option>Select category</option>
				<?php
				$query="SELECT * FROM category ORDER BY dateTime DESC";
				$sql=mysqli_query($conn,$query);
				while($row=mysqli_fetch_assoc($sql))
				{
					$id=$row['id'];
					$category_name =$row['name'];
				?>
					<option><?php echo $category_name; ?></option>
				<?php }?>	
				</select><br>
				
				<label>Select Image:</label><input class="form-control" type="file" name="file_upload"><br>
				<label>Post:</label>
				<textarea class="form-control" name="comment">
				</textarea><br><br>
				
				<input type="submit" class="btn btn-success btn-block" name="press" value="submit">
			</div>
		</form><br><br>
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			
			
		</tbody>
		</table>
		</div>
	</div>
	</div><!--end of row tag-->
</div><!--end of container fluid-->	
</body>
</html>