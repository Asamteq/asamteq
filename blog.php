<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>CMS PHP</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/front.css" rel="stylesheet" type="text/css">
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


<div class="line"></div>

				<!--End of navigation tab-->
<div class="container">
	<h1>Working On CMS Blog System created in Php </h1>
	<p class="lead">This Blog is designed bny walli Rashid</p>
	
	<div class="row">
		<div class="col-sm-8">
	
		<?php
			global $conn;
				$view_data ="SELECT * FROM admin_panel ORDER BY dateTime DESC";
				$result=mysqli_query($conn,$view_data);
			while($row=mysqli_fetch_assoc($result))
			{
				$id = $row['id'];
				$post_id=$row['post'];
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
			if(strlen($post_id)>120)
			{
				$short_post =substr($post_id,0,110);
				echo $short_post."...!";
			}
		?>
		</p>
			<button type="submit" class="btn btn-primary">
			<a href="fullPost.php?post_id=<?php echo $id; ?>">
			<span class="btn-color" style="color:#fff;">
			Read More</span>
			</button>
			</a>
		
		</div>
		</div>
		<?php
		

			
			}
		?>
		</div>
		<div class="col-sm-offset-1 col-sm-3"  style="border:1px solid black; background-color:silver;">
		<h1>Post Area</h1>
		</div>

	</div>
</div>










</body>
</html>
