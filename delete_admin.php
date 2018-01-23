<?php
	require_once("FILES/connection.php");
	require_once("FILES/session.php");
?>
<?php
	$conn;
	if(isset($_GET['del']))
	{
		$delete_admin =$_GET['del'];
		$query= "DELETE FROM admins WHERE id='$delete_admin'";
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
			$_SESSION['success']="Admin is deleted successfully";
			header("Location:admins.php");
		}else{
			$_SESSION['error']="Admin is not deleted";
		}

	}