<?php
	$conn=mysqli_connect("localhost","root","","cms");
	if(!$conn)
	{
		echo "Does not connect with Db".mysqli_connect_error();
	}
	
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Database connection</title>
</head>
<body>
	
</body>
</html>