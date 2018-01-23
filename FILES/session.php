<?php
	session_start();
	function ErrorMessage()
	{
		if(isset($_SESSION['error']))
		{
			$result="<div class='alert alert-danger'>";
			$result.=htmlentities($_SESSION['error']);
			$_SESSION['error']=null;
			$result.="</div>";
			return $result;
		}
		
	}
	function SuccessMessage()
	{
		if(isset($_SESSION['success']))
		{
			$result="<div class='alert alert-success'>";
			$result.=htmlentities($_SESSION['success']);
			$_SESSION['success']=null;
			$result.="</div>";
			return $result;
		}
		
	}

?>