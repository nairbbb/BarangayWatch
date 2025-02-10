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
					<div class="alert alert-primary">REPORT</div>
					
					<div class="row p-3">
						<div class="col-lg-12">
							<h3 class="text-white">Reports</h3>
							<div class="table-responsive p-5 rounded" style="background-color:#fff;">
								<table id="dataTable" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>Ticket no</th>
											<th>Subject</th>
											<th>Report Category</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$tbl_report=$db->displayReports();
									
											while($fetch=$tbl_report->fetch_array()){
										?>
										<tr>
											<td><?php echo $fetch['ticket_no']?></td>
											<td><?php echo $fetch['subject']?></td>
											<td><?php echo $fetch['report_category']?></td>
											<td><?php echo date("M d, Y h:i A", strtotime($fetch['date']))?></td>
											<td><?php echo $fetch['status_report']?></td>
											<td>
												<?php
													if($fetch['status_report'] == "Resolved"){
												?>		
													<a class="btn btn-sm btn-success" href="reportEdit.php?report_no=<?php echo $fetch['report_id']?>">DONE</a>
												<?php
													}elseif($fetch['status_report'] == "Rejected"){
												?>
													<a class="btn btn-sm btn-danger" href="reportEdit.php?report_no=<?php echo $fetch['report_id']?>">REJECT</a>
												<?php
													}else{
												?>
													<a class="btn btn-sm btn-warning" href="reportEdit.php?report_no=<?php echo $fetch['report_id']?>"><i class="fas fa-edit"></i> Edit</a>
												<?php
													}
												?>
											
											</td>
										</tr>
										
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
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