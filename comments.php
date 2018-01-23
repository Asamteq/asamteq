<?php
	include("FILES/session.php");
	include("FILES/connection.php");
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
				<li >
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

				<li class="active"><a href="comments.php">
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
		<h1>Un-Aprroved Commentes</h1>
			<div>
			<?php 
				echo ErrorMessage();
				echo SuccessMessage();

			?>

		</div>	
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Date</th>
					<th>Comment</th>
					<th>Approve</th>
					<th>Delete Comment</th>
					<th>Detail</th>
				</tr>
<?php
	$conn;
	$view_data ="SELECT * FROM comments WHERE status='off' ORDER BY dateTime DESC";
	$result=mysqli_query($conn,$view_data);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($result))
	{
		$id =$row['id'];
		$serial_no++;
		$comment_id 	  = $row['admin_panel_id'];
		$dateTime 		  = $row['dateTime'];
		$commenter_name	  = $row['name'];
		$commenter_email  = $row['email'];
		$comments  		  = $row['comments'];	
		if(strlen($dateTime)>10 AND strlen($comments)>10)
		{
			$dateTime=substr($dateTime,0,10)."..";
			$comments=substr($comments,0,10)."..";
		}
?>
	<tr>
		<td><?php echo $serial_no;?></td>
		<td><?php echo $commenter_name;?></td>
		<td><?php echo $dateTime;?></td>
		<td><?php echo $comments;?></td>
		<td><a href="approve_comment.php?approve=<?php echo $id; ?>" class="btn btn-success">Approve</a></td>
		<td><a href="delete_comment.php?delete=<?php echo $id;?>" class="btn btn-danger">Delete</a></td>
		<td><a href="" class="btn btn-primary">Live Preview</a></td>




	</tr>
<?php
}
?>
		</table>
		</div><!--end of div table responsive -->

		<!-- End of unapprove comment section-->

<h1>Aprroved Commentes</h1>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Date</th>
					<th>Comment</th>
					<th>Dis-Approve</th>
					<th>Delete Comment</th>
					<th>Detail</th>
				</tr>
<?php
	$conn;
	$view_data ="SELECT * FROM comments WHERE status='ON' ORDER BY dateTime DESC";
	$result=mysqli_query($conn,$view_data);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($result))
	{
		$id =$row['id'];
		$serial_no++;
		$comment_id 	  = $row['admin_panel_id'];
		$dateTime 		  = $row['dateTime'];
		$commenter_name	  = $row['name'];
		$commenter_email  = $row['email'];
		$comments  		  = $row['comments'];	
		if(strlen($dateTime)>10 AND strlen($comments)>10)
		{
			$dateTime=substr($dateTime,0,10)."..";
			$comments=substr($comments,0,10)."..";
		}
?>
	<tr>
		<td><?php echo $serial_no;?></td>
		<td><?php echo $commenter_name;?></td>
		<td><?php echo $dateTime;?></td>
		<td><?php echo $comments;?></td>
		<td><a href="disapprove.php?disapprove=<?php echo $id; ?>" class="btn btn-warning">Dis-Approve</a></td>
		<td><a href="delete_comment.php?delete=<?php echo $id;?>" class="btn btn-danger">Delete</a></td>
		<td><a href="" class="btn btn-primary">Live Preview</a></td>




	</tr>
<?php
}
?>
		</table>
		</div><!--end of div table responsive -->

















	</div><!--end of coloumn 8-->

</body>
</html>