<?php
	include("FILES/session.php");
	include("FILES/connection.php");
?>
<?php
	$conn;
	if(isset($_GET['disapprove']))
	{
		$disapprove_cmnt =$_GET['disapprove'];
		$update_status= "UPDATE comments set status='off' WHERE id='$disapprove_cmnt'";
		$execute=mysqli_query($conn,$update_status);
		if($execute)
		{
			$_SESSION['success']="Comment is disapproved by Admin";
			header("Location:comments.php");
		}else{
			$_SESSION['error']="Comment is not disapproved by Admin";
		}

	}

?>