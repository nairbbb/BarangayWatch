<?php
	require 'config.php';
	
	class db_class extends db_connect{	
		
		public function __construct(){
			$this->connect();
		}
		
		/* ADMIN CLASS OPERATION */
		
		public function adminLogin($username, $password){
			$query=$this->conn->prepare("SELECT * FROM `administrator` WHERE `username`='$username' && `password`='$password'") or die($this->conn->error);
			if($query->execute()){
				
				$result=$query->get_result();
				
				$valid=$result->num_rows;
			
				$fetch=$result->fetch_array();
				
				return array(
					'admin_id'=>isset($fetch['admin_id']) ? $fetch['admin_id'] : 0,
					'count'=>isset($valid) ? $valid: 0
				);	
			}
		}
		
		
		/*public function getUser(){
			$query=$this->conn->prepare("SELECT * FROM `user`") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				return $result;
			}
			
		}*/
		
		
		public function displayUser(){
			$query=$this->conn->prepare("SELECT * FROM `user`") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
			
		}
		
		
		public function displayAdmin(){
			$query=$this->conn->prepare("SELECT * FROM `administrator`") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
			
		}
		
		public function banUser($user_id){
			$query=$this->conn->prepare("SELECT * FROM `user` WHERE `user_id`='$user_id'") or die($this->conn->error);
			$query->execute();
				
			$result=$query->get_result();
				
			$valid=$result->num_rows;
			
			$fetch=$result->fetch_array();
			
			$status = $fetch['status'];
			
			$i=0;
				
			if($status == 0){
				$i=1;
				$query=$this->conn->prepare("UPDATE `user` SET `status`=? WHERE `user_id`=?") or die($this->conn->error);
				$query->bind_param("ii", $i, $user_id);
				
				if($query->execute()){
					$query->close();
					$this->conn->close();
					return true;
				}
			}else if($status == 1){
				$i=0;
				$query=$this->conn->prepare("UPDATE `user` SET `status`=? WHERE `user_id`=?") or die($this->conn->error);
				$query->bind_param("ii", $i, $user_id);
				
				if($query->execute()){
					$query->close();
					$this->conn->close();
					return true;
				}
			}
		}
		
		public function getAdmin($admin_id){
			$query=$this->conn->prepare("SELECT * FROM `administrator` WHERE `admin_id` = '$admin_id'") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				$fetch=$result->fetch_array();
				
				return array(
					'firstname'=> $fetch['firstname'],
					'lastname'=> $fetch['lastname']
				);
			}
		}
		
		
		
		public function addBarangayOfficial($username,$password,$firstaname,$lastname,$email,$phone_no){
			$query=$this->conn->prepare("INSERT INTO `administrator` (`username`, `password`, `firstname`, `lastname`, `email`, `phone_no`) VALUES(?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$query->bind_param("ssssss", $username, $password, $firstaname, $lastname, $email, $phone_no);
			
			if($query->execute()){
				$query->close();
				$this->conn->close();
		
			}
			
			
		}
		
		public function deleteBarangayOfficial($admin_id){
			$query=$this->conn->prepare("DELETE FROM `administrator` WHERE `admin_id` = '$admin_id'") or die($this->conn->error);
			
			if($query->execute()){
				$query->close();
				$this->conn->close();
			}
			
		}
		
		public function addNews($title,$post,$author,$date){
			$query=$this->conn->prepare("INSERT INTO `news` (`title`, `post`, `author`, `date_created`) VALUES(?, ?, ?, ?)") or die($this->conn->error);
			$query->bind_param("ssss", $title, $post, $author, $date);
			
			if($query->execute()){
				$query->close();
				$this->conn->close();
		
			}	
		}
		
		
		public function displayNews(){
			$query=$this->conn->prepare("SELECT * FROM `news` LEFT JOIN `administrator` ON news.author = administrator.admin_id ORDER BY `news_id` DESC LIMIT 5") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function displayListNews(){
			$query=$this->conn->prepare("SELECT * FROM `news` LEFT JOIN `administrator` ON news.author = administrator.admin_id ORDER BY `news_id` DESC") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function get_time_ago($time){
			date_default_timezone_set("Etc/GMT-8");
			
			$time_in_seconds = strtotime($time);
			$current_time = time();
			$difference_in_seconds = $current_time - $time_in_seconds;
			$seconds = $difference_in_seconds;
			$minutes = round($seconds/60);
			$hours = round($seconds/3600);
			$days = round($seconds/86400);
			$weeks = round($seconds/604800);
			$months = round($seconds/2629440);
			$years = round($seconds/31553280);
	
			if($seconds <= 60){
				return "Just Now";
	
			}else if($minutes <= 60){
				if($minutes == 1){
					return "1 min ago";
				}else{
					return "$minutes mins ago";
				}
	
			}else if($hours <=24){
				if($hours == 1){
					return "1 hr ago";
				}else{
					return "$hours hrs ago";
				}
			}else if($days <= 7){
				if($days == 1){
					return "yesterday";
				}else{
					return "$days days ago";
				}
			}else if($weeks <= 4.3){
				if($weeks == 1){
					return "a week ago";
				}else{
					return "$weeks weeks ago";
				}
			}else if($months <= 12){
				if($months == 1){
					return "1 month ago";
				}else{
					return "$months months ago";
				}
			}else{
				if($years == 1){
					return "1 yr ago";
				}else{
					return "$years yrs ago";
				}
			}
		}
		
		public function displaySingleNews($news_id){
			date_default_timezone_set("Etc/GMT-8");
			$query=$this->conn->prepare("SELECT * FROM `news` LEFT JOIN `administrator` ON news.author=administrator.admin_id WHERE `news_id` = '$news_id'") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		
		public function converTimeToString($time){
			return get_time_ago($time);		
		}
		
		/* USER CLASS OPERATION */
		
		
		public function getUser($user_id){
			$query=$this->conn->prepare("SELECT * FROM `user` WHERE `user_id` = '$user_id'") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				$fetch=$result->fetch_array();
				
				return array(
					'firstname'=> $fetch['firstname'],
					'lastname'=> $fetch['lastname']
				);
			}
		}
		
		public function getUserInfo($user_id){
			$query=$this->conn->prepare("SELECT * FROM `user` WHERE `user_id` = '$user_id'") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function signup($firstname,$lastname,$email,$password,$phone_no,$status){
			$query=$this->conn->prepare("INSERT INTO `user` (`firstname`, `lastname`, `email`, `password`, `phone_no`, `status`) VALUES(?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$query->bind_param("sssssi", $firstname, $lastname, $email, $password, $phone_no, $status);
			
			if($query->execute()){
				$query->close();
				$this->conn->close();
			
			}
			
			
			/*
			if($query->execute()){
				$query->close();
				$this->conn->close();
				
				return array(
					'message'=>'Signup succesfully'
				);
				
			}else{
				return array(
					'error'=> false
				);

			*/
		}
		
		
		public function login($email, $password){
			$query=$this->conn->prepare("SELECT * FROM `user` WHERE `email`='$email' && `password`='$password'") or die($this->conn->error);
			if($query->execute()){
				
				$result=$query->get_result();
				
				$valid=$result->num_rows;
			
				$fetch=$result->fetch_array();
				
				return array(
					'user_id'=>isset($fetch['user_id']) ? $fetch['user_id'] : 0,
					'count'=>isset($valid) ? $valid: 0
				);	
			}
		}
		
		public function submitReport($ticket_no,$subject,$message,$report_category,$address,$date,$status,$user_id){
			$query=$this->conn->prepare("INSERT INTO `report` (`ticket_no`, `subject`, `message`, `report_category`, `address`, `date`, `status_report`, `user_id`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$query->bind_param("issssssi", $ticket_no, $subject, $message, $report_category, $address, $date, $status, $user_id);
			
			if($query->execute()){
				$query->close();
				$this->conn->close();
			
			}
			
		}
		
		public function checkTicket($ticket_no){
			$query=$this->conn->prepare("SELECT * FROM `report` WHERE `ticket_no`='$ticket_no'") or die($this->conn->error);
			if($query->execute()){
				
				$result=$query->get_result();
				
				$valid=$result->num_rows;
			
				$fetch=$result->fetch_array();
				
				return $valid;
			}
		}
		
		public function submitFile($file_name,$file_type,$ticket_no,$user_id){
			$query=$this->conn->prepare("INSERT INTO `file`(`file_name`, `file_type`, `ticket_no`, `user_id`) VALUES(?, ?, ?, ?)") or die($this->conn->error);
			$query->bind_param("ssii", $file_name, $file_type, $ticket_no, $user_id);
			
			$query->execute();
			
		}
		
		public function displayUserReport($user_id){
			$query=$this->conn->prepare("SELECT * FROM `report` WHERE `user_id` = '$user_id' ORDER BY `report_id` DESC") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function displaySingleReport($report_id){
			$query=$this->conn->prepare("SELECT * FROM `report` WHERE `report_id`='$report_id'") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function displayImage($ticket_no){
			$query=$this->conn->prepare("SELECT * FROM `file` WHERE `ticket_no`='$ticket_no'") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function countImage($ticket_no){
			$query=$this->conn->prepare("SELECT * FROM `file` WHERE `ticket_no`='$ticket_no'") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				$count=$result->num_rows;
				return $count;
			}
		}
		
		public function submitFeedback($subject,$message,$user_id){
			$query=$this->conn->prepare("INSERT INTO `feedback`(`subject`, `message`, `user_id`) VALUES(?, ?, ?)") or die($this->conn->error);
			$query->bind_param("ssi", $subject, $message, $user_id);
			
			$query->execute();
			
		}
		
		public function displayReports(){
			$query=$this->conn->prepare("SELECT * FROM `report` LEFT JOIN `user` ON report.user_id=user.user_id") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		public function displayFile($ticket_no){
			$query=$this->conn->prepare("SELECT * FROM `file` LEFT JOIN `user` ON file.user_id=user.user_id WHERE `ticket_no`= $ticket_no") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		
		public function displaySingleReports($report_id){
			$query=$this->conn->prepare("SELECT * FROM `report` LEFT JOIN `user` ON report.user_id=user.user_id WHERE `report_id` = '$report_id'") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				
				return $result;
			}
		}
		
		
		public function updateReport($status,$report_id){
			$query=$this->conn->prepare("UPDATE `report` SET `status_report`=? WHERE `report_id`='$report_id'") or die($this->conn->error);
			$query->bind_param("s", $status);
			
			$query->execute();
			
		}
		
		
		public function countTotal($status){
			$query=$this->conn->prepare("SELECT * FROM `report` WHERE `status_report`` = '$status'") or die($this->conn->error);
			
			if($query->execute()){
				$result=$query->get_result();
				return $result;
			}
		}

		public function tanodLogin($email, $password){
			$query=$this->conn->prepare("SELECT * FROM `tanoduser` WHERE `email`='$email' && `password`='$password' && `position` = '1' ") or die($this->conn->error);
			if($query->execute()){
				
				$result=$query->get_result();
				
				$valid=$result->num_rows;
			
				$fetch=$result->fetch_array();
				
				return array(
					'tanod_id'=>isset($fetch['tanod_id']) ? $fetch['tanod_id'] : 0,
					'count'=>isset($valid) ? $valid: 0
				);	
			}
		}

		public function tanodSignup($firstname,$lastname,$email,$password,$phone_no,$position){
			$query=$this->conn->prepare("INSERT INTO `tanoduser` (`firstname`, `lastname`, `email`, `password`, `phone_no`, `position`) VALUES(?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$query->bind_param("sssssi", $firstname, $lastname, $email, $password, $phone_no, $position);
			
			if($query->execute()){
				$query->close();
				$this->conn->close();
			
			}

		}

		public function getTanod($tanod_id){
			$query=$this->conn->prepare("SELECT * FROM `tanoduser` WHERE `tanod_id` = '$tanod_id'") or die($this->conn->error());
			
			if($query->execute()){
				$result=$query->get_result();
				
				$fetch=$result->fetch_array();
				
				return array(
					'firstname'=> $fetch['firstname'],
					'lastname'=> $fetch['lastname']
				);
			}
		}
 	}	
?>