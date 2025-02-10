<?php
	require_once'class.php';
	
	
	$data = array();
 	
	$db = new db_class();
	
	$tbl_news=$db->displayListNews();
											
	while($fetch=$tbl_news->fetch_array()){
		$data[] = $fetch;
	}
	
	
	foreach($data as $key => $val){
		$time = date("M d, Y h:i A", strtotime($data[$key]['date_created']));
		$trim= mb_strimwidth($data[$key]['post'], 0, 90, "..."); 
		$post=str_replace(array("<br />"), '', $trim);
		$title=htmlspecialchars_decode($data[$key]['title']);
		$data[$key]['date_created']=$time;
		$data[$key]['post']=$post;
		$data[$key]['title']=$title;

	}
	
	echo json_encode($data);

?>