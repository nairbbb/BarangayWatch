<?php
	require_once'class.php';
	

	if($_REQUEST['user_id']){
		
		$user_id=$_REQUEST['user_id'];

		
		$db=new db_class();
		
		$db->banUser($user_id);
		
		echo"<script>window.location='member.php'</script>";
	}
?>