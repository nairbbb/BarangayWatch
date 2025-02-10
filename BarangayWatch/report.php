<!DOCTYPE html>
<?php
	session_start();
	
	require_once'admin/class.php';
	
	$db = new db_class();
	
	if(!ISSET($_SESSION['user_id'])){
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
    <link href="css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
	<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-text mx-2">BarangayWatch</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="report.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Report</span></a>
            </li>
			
				<!-- Divider -->
            <hr class="sidebar-divider my-0">
			
			<li class="nav-item">
              <a class="nav-link" href="report_status.php">
                  <i class="fas fa-fw fa-calendar"></i>
                  <span>Report Status</span></a>
            </li>
			
			 <!-- Divider -->
            <hr class="sidebar-divider my-0">
	
			
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="news.php">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>News</span></a>
            </li>
			 <!-- Divider -->
            <hr class="sidebar-divider my-0">
			
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="feedback.php">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Feedback</span></a>
            </li>
			
			
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
								<?php
									$getUser=$db->getUser($_SESSION['user_id']);
									
									echo $getUser['firstname']." ".$getUser['lastname'];
								?>
								</span>
                                <img class="img-profile rounded-circle" src="img/user.png" width="25" height="25" />
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Report</h1>
					<div class="alert alert-info">
						<h6 class="text-center small">Please kindly report the incident with a complete details</h6>
					</div>
					<form method="POST" action="submitReport.php" enctype="multipart/form-data">
						<?php
							$getUserDetail=$db->getUserInfo($_SESSION['user_id']);
							$fetch=$getUserDetail->fetch_array();
						?>
						<div class="form-group mt-3">
							<label>Subject</label>
							<input type="text" name="subject" class="form-control" required="required"/>
							<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>"/>
						</div>
						<div class="form-group mt-3">
							<label>Message</label>
							<textarea name="message" class="form-control" style="resize:none;" rows="5" required="required"></textarea>
						</div>
						<div class="form-group">
							<label>Report Category</label>
							<select class="form-control text-center" name="report_category" required="required">
								<option value="">--Select an option--</option>
								<option value="Theft">Theft</option>
								<option value="Noise Complaint">Noise Complaint</option>
								<option value="Accident">Accident</option>
								<option value="Assault">Assault</option>
								<option value="Riot">Riot</option>
								<option value="Vandalism">Vandalism</option>
								<option value="Property Damage">Property Damage</option>
								<option value="Drug Related">Drug Related</option>
								<option value="Harrasment">Harrasment</option>
								<option value="Blocking Driving">Blocking Driving</option>
								<option value="Stalking">Stalking</option>
								<option value="Fire">Fire</option>
							</select>
						</div>
						<div class="form-group">
							<label>Upload Image</label>
							<br />
							<input name="reportImage[]" id="image" accept="image/*" type="file" multiple required="required"/>
						</div>
						<div class="form-group">
							<label>Upload Video</label>
							<br />
							<small class="text-danger">*Optional to upload video</small>
							<input name="reportVideo" accept="video/mp4,video/x-m4v,video/*" type="file"/>
						</div>
						<div class="form-group">
							<div class="location-container">	
								<div id="map"></div>
								<div id="address"></div>
								<button type="button"  class="form-control" id="findLocation" onclick="initMap()">My Location</button>
							</div>
						</div>
						<input type="hidden" id="user_add" name="user_add"/>
						<div class="form-group">
							<button type="submit" name="submit-report" class="btn btn-primary btn-block" id="submit-report" disabled="disabled">Submit</button>
						</div>
					</form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BarangayWatch 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
	<script src="js/map.js"></script>
	<script>
		$(document).ready(function(){
			let max_file = 3;
			$file_upload = $("#image");
			$button = $("#submit-report");
			
			$file_upload.on('change', function(){
				let image_no = $(this)[0].files.length;
				if(image_no > max_file){
					alert("You can only upload maximum 3 files");
					$(this).val("");
					$button.attr("disabled", "disabled");	
				}else{
					$button.removeAttr("disabled");
				}
			});
		});
	</script>
	
</body>

</html>