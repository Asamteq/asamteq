<?php
	include("FILES/session.php");
	include("FILES/connection.php");
?>
<?php
	if(isset($_GET['delete']))
	{
		$del_id=$_GET['delete'];
		$query ="DELETE FROM admin_panel WHERE id='$del_id'";
		$execute=mysqli_query($conn,$query);
		$fetch_data=mysqli_fetch_assoc($execute);
		$image_name=$fetch_data['image'];
		if($execute)
		{
			unlink("upload/".$image_name);
			header("Location:dashboard.php");
		}
	}

?>