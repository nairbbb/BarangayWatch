<?php
require_once'../admin/class.php';

if(ISSET($_POST['register'])){
	$firstname=htmlspecialchars($_POST['firstname']);
	$lastname=htmlspecialchars($_POST['lastname']);
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$phone_no=$_POST['phone_no'];
	$position=1;
	$db = new db_class();
	
	$db->tanodSignup($firstname,$lastname,$email,$password,$phone_no,$position);
	
	
	echo "<script>window.location='index.php'</script>";
}
?>