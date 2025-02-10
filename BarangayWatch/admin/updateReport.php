<?php
require_once'class.php';

if(ISSET($_POST['button-update'])){
	$status=$_POST['status'];
	$report_id=$_POST['report_id'];
	
	$db=new db_class();
	
	$db->updateReport($status,$report_id);

	echo"<script>window.location='report.php'</script>";
}

?>