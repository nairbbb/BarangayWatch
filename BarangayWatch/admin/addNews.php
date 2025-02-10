<?php
date_default_timezone_set("Etc/GMT-8");

require_once'class.php';

if(ISSET($_POST['postButton'])){
	$title=htmlspecialchars($_POST['title']);
	$post=nl2br(htmlspecialchars($_POST['post']));
	$author=htmlspecialchars($_POST['admin_id']);
	
	$date = date("Y-m-d H:i:s");
	
	$db=new db_class();
	
	$db->addNews($title,$post,$author,$date);
	
	echo"<script>window.location='barangayNews.php'</script>";
	
}

?>