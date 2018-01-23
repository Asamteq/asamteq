<?php
	include("FILES/session.php");
	include("FILES/connection.php");
?>
<?php
	$conn;
	if(isset($_GET['delete']))
	{
		$delete_cmnt =$_GET['delete'];
		$query= "DELETE FROM comments WHERE id='$delete_cmnt'";
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
			$_SESSION['success']="Comment is deleted by Admin";
			header("Location:comments.php");
		}else{
			$_SESSION['error']="Comment is not deleted by Admin";
		}

	}

?>