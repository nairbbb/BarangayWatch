<?php
	session_start();
	
	unset($_SESSION['admin_id']);
	
	echo "<script>window.location='index.php'</script>";
?>