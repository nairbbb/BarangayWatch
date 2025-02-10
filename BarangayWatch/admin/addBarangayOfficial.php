<?php
require_once'class.php';

if(ISSET($_POST['create'])){
	$username=htmlspecialchars($_POST['username']);
	$password=htmlspecialchars($_POST['password']);
	$firstname=htmlspecialchars($_POST['firstname']);
	$lastname=htmlspecialchars($_POST['lastname']);
	$email=htmlspecialchars($_POST['email']);
	$phone_no=$_POST['phone_no'];
	
	
	$db=new db_class();
	
	
	$db->addBarangayOfficial($username,$password,$firstname,$lastname,$email,$phone_no);
	
	echo "<script>window.location='member.php'</script>";
}



?>