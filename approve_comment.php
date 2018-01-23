<?php
	include("FILES/session.php");
	include("FILES/connection.php");
?>
<?php
	$conn;
	if(isset($_GET['approve']))
	{
		$approve_cmnt =$_GET['approve'];
		$update_status= "UPDATE comments set status='ON' WHERE id='$approve_cmnt'";
		$execute=mysqli_query($conn,$update_status);
		if($execute)
		{
			$_SESSION['success']="Comment is approved by Admin";
			header("Location:comments.php");
		}else{
			$_SESSION['error']="Comment is not approved by Admin";
		}

	}

?>