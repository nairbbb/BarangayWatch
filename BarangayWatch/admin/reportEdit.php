<!DOCTYPE html>
<?php
	session_start();
	
	require_once'class.php';
	
	$db = new db_class();
	
	if(!ISSET($_SESSION['admin_id'])){
		echo"<script>window.location='index.php'</script>";
	}

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BarangayWatch</title>

    <!-- Custom fonts for this template-->
    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark shadow-5-strong topbar mb-4 static-top">
					<!-- Topbar Navbar -->
					
					 <!-- Nav Item - User Information -->
				
					<a class="navbar-brand" href="#">
						<img src="../img/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt=""> BarangayWatch
					</a>
					
					<div class="collapse navbar-collapse">
						<ul class="navbar-nav">
							<li class="nav-item active">
								<a class="nav-link" href="home.php">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="liveTrack.php">Live Track</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="barangayNews.php">Barangay News</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="report.php">Reports</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="member.php">Members</a>
							</li>
						
						</ul>
					</div>
					
					
                   
                    <ul class="navbar-nav ml-auto">
						
                        <li class="nav-item dropdown no-arrow">
						
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="../img/user.png" width="30" height="30" class="d-inline-block align-top" alt="">&nbsp;&nbsp;<span class="mr-2 d-none d-lg-inline text-light medium">
									<?php
										$getUser=$db->getAdmin($_SESSION['admin_id']);
										
										echo $getUser['firstname']." ".$getUser['lastname'];
									?>
								
								</span>
                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="settings.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="activity_log.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<div class="alert alert-primary">REPORT/EDIT</div>
					<div class="card mt-1 mb-1">
						<div class="card-body">
							<?php
								if(ISSET($_GET['report_no']) && $_GET['report_no'] != null){
									$tbl_report=$db->displaySingleReports($_GET['report_no']);
									$fetch=$tbl_report->fetch_array();
									
							?>
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-6 float-left">
										<h4>Ticket no:</h4>
										<h5 class="text-primary"><?php echo $fetch['ticket_no']?></h5>
									</div>
									
									<div class="col-lg-6 float-right text-right">
										<h4>Status:</h4>
										<h5>
										<?php
											switch($fetch['status_report']){
												case "Reviewing":
													echo "<small class='bg-dark text-white p-1 rounded'>".$fetch['status_report']."</small>";
													break;
													
												case "Onhold":
													echo "<small class='bg-warning text-light p-1 rounded'>".$fetch['status_report']."</small>";
													break;	
													
												case "Rejected":
													echo "<small class='bg-danger text-light p-1 rounded'>".$fetch['status_report']."</small>";
													break;
													
												case "Resolved":
													echo "<small class='bg-success text-light p-1 rounded'>".$fetch['status_report']."</small>";
													break;
													
												default:
													echo "No Data Found";
											}	
										?>
										</h5>
									</div>	
								</div>	
							</div>	
							<hr />
							<div class="row">
								<div class="col-lg-12">
									<h5>Subject:</h5>
									<div class="border rounded p-2"><?php echo $fetch['subject']?></div>
								</div>
							
								<div class="col-lg-12 mt-2">
									<h5>Message:</h5>
									<div class="border rounded p-2"><?php echo $fetch['message']?></div>
								</div>
								
								<div class="col-lg-12 mt-2">
									<h5>Report Category:</h5>
									<p class="rounded bg-primary text-light p-2"><?php echo $fetch['report_category']?></p>
								</div>
								
								<div class="col-lg-12 mt-2">
									<h5>Address:</h5>
									<p class="rounded bg-success text-light p-2">Report Category: <?php echo $fetch['address']?></p>
								</div>
								
								
								<div class="col-lg-12 mt-2">
									<h5>Submitted File:</h5>
									<div class="alert alert-info">Images</div>
									<div class="row">
										<?php
											$tbl_file=$db->displayFile($fetch['ticket_no']);
											while($row=$tbl_file->fetch_array()){
												if($row['file_type'] == "image"){
										?>
												<div class="col-lg-4">
													<img src="<?php echo "../user_files/".$row['user_id']."/".$row['ticket_no']."/".$row['file_name'];?> " style="height:250px;" width="100%"/>
												</div>
										<?php
												}
											}
										?>
									</div>		
								</div>
								<div class="col-lg-12 mt-2">
									<div class="alert alert-info">Video</div>
									<div class="row">
										<?php
											$tbl_file=$db->displayFile($fetch['ticket_no']);
											while($row=$tbl_file->fetch_array()){
												if($row['file_type'] == "video"){
										?>
												<div class="col-lg-12">
													
													<div id="trailer" class="section d-flex justify-content-center embed-responsive embed-responsive-21by9">
													<video class="embed-responsive-item" controls autoplay loop muted>
															<source src="<?php echo "../user_files/".$row['user_id']."/".$row['ticket_no']."/".$row['file_name'];?> ">
															Your browser does not support the video tag.
														</video>
													</div>
												</div>
										<?php
												}
											}
										?>
									</div>		
								</div>
								<?php 
									if(($fetch['status_report'] != "Resolved") && ($fetch['status_report'] != "Rejected")){
								?>
								<div class="col-lg-12 mt-2">
									<h3>Status Report</h3>
									<form method="POST" action="updateReport.php">
										<div class="form-group col-lg-4">
											<select name="status" class="form-control text-center" required="required">
												<option value="">-------- Select an option -------- </option>
												<option value="Reviewing">Reviewing</option>
												<option value="Onhold">Onhold</option>
												<option value="Rejected">Rejected</option>
												<option value="Resolved">Resolved</option>
											</select>
										</div>	
										

										<div class="col text-center mt-5">
											<input type="hidden" value="<?php echo $fetch['report_id']?>" name="report_id"/>
											<button type="submit" name="button-update" class="btn btn-lg btn-warning">Update</a>
										</div>
									</form>
								</div>
								<?php
									}
								?>
								<div class="col-lg-12 mt-3 text-center">
										<small>Date Submitted: <?php echo date("M d, Y - h: i A", strtotime($fetch['date']))?></small>
								</div>
							</div>
							<?php
								}else{
									echo "<h1>NO DATA FOUND</h1>";
								}
							?>
						</div>
					</div>		
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="fixed-bottom navbar-dark shadow-5-strong">
                <div class="container my-auto">
                    <div class="copyright text-light text-center my-auto">
                        <span>Copyright &copy; BarangayWatch 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">System Notification</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php?admin_id=<?php echo $_SESSION['admin_id']?>">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
	<script src="../js/jquery.dataTables.js"></script>
    <script src="../js/dataTables.bootstrap4.js"></script>
	<script>
		$(document).ready(function(){
			$('#dataTable').DataTable();
		})
	</script>

    <!-- Core plugin JavaScript-->
    <script src="../js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>