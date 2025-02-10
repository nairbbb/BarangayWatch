<?php
require_once'class.php';

if(ISSET($_REQUEST['admin_id'])){
	$admin_id=$_REQUEST['admin_id'];
	
	$db = new db_class();
	$db->deleteBarangayOfficial($admin_id);
	
	echo "<script>window.location='member.php'</script>";
}

?>