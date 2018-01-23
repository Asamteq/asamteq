<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");
?>
	<?php	
	if(isset($_POST['press']))
	{
		$get_id=$_REQUEST['post_id'];
		$name =mysqli_real_escape_string($conn,$_POST['name']);
		$email = $_POST['email'];
		$comment =$_POST['comment'];
		date_default_timezone_set("Asia/Karachi");
		$time=time();
	    $real_time=strftime("%B-%d-%Y %H:%M:%S",$time);
		$admin="Walli Rashid";
		if(empty($name) OR empty($email) OR empty($comment))
		{
			$_SESSION['error']="Please fill out the spicified field to comment";
		}
		else if(strlen($name)>30)
		{
			 $_SESSION['error']="You name is too big";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			 $_SESSION['error']="You email is Incorrect";
		}
		else if(strlen($email)>30)
		{
			 $_SESSION['error']="You email is too big please provide email less than 30 characters";
		}
		else{
			$sql="INSERT INTO comments(dateTime,name,email,comments,status,admin_panel_id)
			VALUES('$real_time','$name','$email','$comment','off','$get_id')";
			$execute=mysqli_query($conn,$sql);
			if($execute)
			{
				 $_SESSION['success']="Your comment is subimmted just wait for your admin approval";
			}else{
				 $_SESSION['error']="Your comment is not submitted";
			}

		}
	}	

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>CMS PHP</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/front.css" rel="stylesheet" type="text/css">
	<style type="text/css">
	.comment-section{
		border:1px solid #cccccc;
		background-color: #cccccc;
	}
	.comment-text-color{
		color:blue;
	}
	.date-alignment{
		margin-left:80px;
	}
	</style>
	<script src="js/jquery.js" type="text/JavaScript"></script>
	<script src="js/bootstrap.js" type="text/JavaScript"></script>
</head>
<body>
<div class="line"></div>
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
		<li><a href="">Blog</a></li>
		<li><a href="">About</a></li>
		<li><a href="">Services</a></li>
		<li><a href="">Contact Us</a></li>
		<li><a href="">Feature</a></li>
	</ul>
	<form action="" class="navbar-form" method="GET">
	<div class="form-group">
		<input type="text" name="search" class="form-controls"
		placeholder="Search Anything" style="padding:3px;">
		
		<input type="submit" name="search_data"
		class="btn btn-primary" value="Search">
		
	</div>
	</form>
</div>
</nav>
<div class="line"></div>

				<!--End of navigation tab-->
<div class="container">
	<h1>Working On CMS Blog System created in Php </h1>
	<p class="lead">This Blog is designed by walli Rashid</p>
	<div class="row">
		<div class="col-sm-8">
		<?php
			echo ErrorMessage();
			echo SuccessMessage();
		?>

		<?php
			global $conn;
			if(isset($_REQUEST['post_id']))
			{
				$fullPost =$_REQUEST['post_id'];
			}
				$view_data ="SELECT * FROM admin_panel
				where id = '$fullPost'
				ORDER BY dateTime DESC";
				$result=mysqli_query($conn,$view_data);
			while($row=mysqli_fetch_assoc($result))
			{
				$id = $row['id'];
				$text_data=$row['post'];
			?>	
		<div class="thumbnail">
			<img class="img-responsive img-rounded" src="upload/<?php echo $row['image'];?>">
		<div class="caption">
		<h1 class="heading-style"><?php echo htmlentities($row['title']); ?></h1>
		<p class="description">Category:<span class="color"><?php echo htmlentities($row['category']);?></span></p>
		<span class="color">Published On:</span><?php echo htmlentities($row['dateTime'])?>
		<br>
		<p class="post">
		<?php
				echo $text_data;
		
		?>
		</p>
		</div>
		</div>
		<?php
			}
		?>
		<br><br>
		<?php
			$conn;
			if(isset($_GET['post_id']))
			{
				$comment_id =$_GET['post_id'];
				$view_data="SELECT * FROM comments WHERE admin_panel_id='$comment_id' AND status='off'";
				$view_query=mysqli_query($conn,$view_data);
				while($row=mysqli_fetch_assoc($view_query))
				{
					$id = $row['admin_panel_id'];
					$dateTime = $row['dateTime'];
					$commenter_name =$row['name'];
					$mail= $row['email'];
					$comments =$row['comments'];
			?>
			<div class="comment-section">
				<img src="images/comment.png" width="70px" height="60px" class="pull-left">
				<p>&nbsp;&nbsp;<span class="comment-text-color">Commenter Name:</span><?php echo $commenter_name; ?></p>
				<p>&nbsp;&nbsp;<?php echo $comments;?></p>
				<p class="date-alignment"><?php echo $dateTime; ?></p>

			</div>
		<?php
		}}
		?><br><br
		</div><!--end of comment section-->
		<div class="form-group">
			<form action="" method="post">
				<label>Name:</label>
				<input type="text" class="form-control" name="name" placeholder="Enter Name"><br>
				<label>Email:</label>
				<input type="email" class="form-control" name="email" placeholder="Enter email"><br>
				<label>Comment Section</label>
				<textarea class="form-control" name="comment">
				</textarea><br><br>
				<input type="submit" class="btn btn-primary btn-md" name="press" value="submit">
			</div>
			</form><!--end of form tag-->
		</div><!--end of col 8-->

									<!--Right side Area-->
		<div class="col-sm-offset-1 col-sm-3"  style="border:1px solid black; background-color:silver;">
		<h1>Post Area</h1>
		</div>

	</div>
</div>
</body>
</html>
