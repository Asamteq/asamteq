<?php
require_once("FILES/connection.php");
require_once("FILES/session.php");
?>
<?php	
if(isset($_GET['update']))
{
	$update_id	=$_GET['edit']; 
	$title		=$_GET['title'];
	$option 	=$_GET['category'];
	$comment    =$_GET['comment'];
	$sql 		="UPDATE admin_panel set title='$title',
				category ='$option', post='$comment'
				WHERE id ='$update_id'";
	$execute	=mysqli_query($conn,$sql);
	if($execute)
	{
		$_SESSION['success']="Data is  updated successfully";
	}else{
	$_SESSION['error']="Data is not updated successfully";

		}
}		
?>

<?php
if(isset($_GET['edit']))
{
$get_id =$_GET['edit'];
$view_query ="Select * FROM admin_panel WHERE id='$get_id'";
$execute	=mysqli_query($conn,$view_query);
$row = mysqli_fetch_assoc($execute);

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
<div class="container-fluid">
<div class="row">
	<div class="col-md-2" id="color">
		<h2>Admin Area</h2>
		<ul class="nav nav-pills nav-stacked" id="main-menu">
			<li ><a href="dashboard.php">
			<span class="glyphicon glyphicon-th"> Dashboard</span>
			</a></li>
			<li><a href="addPost.php">
			<span class="glyphicon glyphicon-list-alt">
			AddNewPost</span></a></li>

			<li ><a href="category.php">
			<span class="glyphicon glyphicon-tags">
			Categories</span></a></li>

			<li><a href="">
			<span class="glyphicon glyphicon-user"> ManageAdmins
			</span></a></li>

			<li><a href="">
			<span class="glyphicon glyphicon-comment"> Comments
			</span></a></li>

			<li><a href="">
			<span class="glyphicon glyphicon-equalizer"> LiveBlog
			</span></a></li>

			<li><a href="">
			<span class="glyphicon glyphicon-log-out"> Logout
			</span></a></li>
			</ul>
</div><!--End of meduim colorum 2 This coloumn consist of left panel-->

	<div class="col-md-8">
	<form action="" method="GET">
		<h2>Edit Post</h2>
		<div>
			<?php echo ErrorMessage(); 
			echo SuccessMessage(); 
			?>
		</div>
		<div class="form-group">
			<label>Title:</label>

<!-- 
YOU DID NOT SPECIFIED ID HERE IN A HIDDEN INPUT FIELD TO UPDATE A RECORD	
-->
			<input type="hidden" name="edit" value="<?= $get_id ?>">

			<input type="text" class="form-control" 
			name="title" value="<?php echo $row['title'];?>">
			<br>

			<label>Select Option:</label>
			<select name="category" class="form-control">

			<option>
			<?php echo $row['category'];?></option>
			</select>
			<br>

			<label>Post:</label>
			<textarea name="comment" class="form-control" >
			<?php echo $row['post']; ?>
			</textarea>

			<br>
			<input type="submit" class="btn btn-success btn-block" name="update" value="Update">	
<?php 
}
?>
	</form><br><br>	
	</div><!--End of coloumn meduim 8 that contain form fields-->
</div><!--end of row tag-->
</div><!--end of container fluid-->	
</body>
</html>