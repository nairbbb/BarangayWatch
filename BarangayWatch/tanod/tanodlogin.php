<?php
	require_once'../admin/class.php';
	session_start();
	
	if(ISSET($_POST['login'])){
	
		$db=new db_class();
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$get_id=$db->tanodLogin($email, $password);
		
		
		if($get_id['count'] > 0){
			$_SESSION['tanod_id']=$get_id['tanod_id'];
			unset($_SESSION['tanod_message']);
			echo"<script>window.location='tanodHome.php'</script>";
		}else{
			$_SESSION['tanod_message']="Invalid Username or Password";
			echo"<script>window.location='index.php'</script>";
		}
	}
?>