<?php
	require_once'class.php';
	session_start();
	
	if(ISSET($_POST['login'])){
	
		$db=new db_class();
		$username=$_POST['username'];
		$password=$_POST['password'];
		$get_id=$db->adminLogin($username, $password);
		
		if($get_id['count'] > 0){
			$_SESSION['admin_id']=$get_id['admin_id'];
			unset($_SESSION['message']);
			echo"<script>window.location='home.php'</script>";
		}else{
			$_SESSION['message']="Invalid Username or Password";
			echo"<script>window.location='index.php'</script>";
		}
	}
?>