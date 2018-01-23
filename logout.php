<?php
	include("FILES/session.php");
	include("FILES/connection.php");
?>
<?php
	session_start();
	session_destroy();
	header("Location:login.php");

?>