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
					<div class="alert alert-primary">MEMBER</div>
					<ul class="nav nav-pills mb-3 mt-5" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="pills-residence-tab" data-toggle="pill" data-target="#residence" type="button" role="tab" aria-controls="pills-residence" aria-selected="true">Residence</button>
						</li>
						<?php
							if($_SESSION['admin_id'] == 1){
						?>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="pills-barangay-official-tab" data-toggle="pill" data-target="#barangay-official" type="button" role="tab" aria-controls="pills-barangar-official" aria-selected="false">Barangay Official</button>
						</li>
						<?php
							}
						?>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="residence" role="tabpanel" aria-labelledby="pills-residence-tab">
							<div class="row p-5">
								<div class="col-lg-12">
									<div class="table-responsive p-5 rounded" style="background-color:#fff;">
										<table id="dataTable" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
													<th>Password</th>
													<th>Phone no</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$tbl_user=$db->displayUser();
											
													while($fetch=$tbl_user->fetch_array()){
												?>
												<tr>
													<td><?php echo $fetch['firstname']?></td>
													<td><?php echo $fetch['lastname']?></td>
													<td><?php echo $fetch['email']?></td>
													<td><?php echo str_repeat("*", 8)?></td>
													<td><?php echo $fetch['phone_no']?></td>
													<td>
														<?php
															if($fetch['status'] == 0){
																echo "";
															}else if($fetch['status'] == 1){
														?>
															<div class="p-1 bg-danger text-white">Banned</div>
														<?php
															}
														?>
														
													</td>
													
													<td>	
														<?php
															if($fetch['status'] == 0){
														?>
															<button class="btn btn-danger" href="#" data-toggle="modal" data-target="#bannedModal<?php echo $fetch['user_id']?>"><i class="fa fa-ban fa-1x"></i> Ban</button>
														<?php
															}else if($fetch['status'] == 1){
														?>
															<button class="btn btn-warning" href="#" data-toggle="modal" data-target="#unbannedModal<?php echo $fetch['user_id']?>"><i class="fa fa-unlock"></i> Unban</button>
														<?php
															}
														?>
													</td>
												</tr>
												
												
												<!-- Banned Modal-->
												<div class="modal fade" id="bannedModal<?php echo $fetch['user_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
													aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header alert-danger">
																<h5 class="modal-title" id="exampleModalLabel">System Notification</h5>
																<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">×</span>
																</button>
															</div>
															<div class="modal-body">Are you sure you want to ban this account?</div>
															<div class="modal-footer">
																<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
																<a class="btn btn-danger" href="ban.php?user_id=<?php echo $fetch['user_id']?>">Confirm</a>
															</div>
														</div>
													</div>
												</div>
												
												<div class="modal fade" id="unbannedModal<?php echo $fetch['user_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
													aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header alert-warning">
																<h5 class="modal-title" id="exampleModalLabel">System Notification</h5>
																<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">×</span>
																</button>
															</div>
															<div class="modal-body">Are you sure you want to unban this account?</div>
															<div class="modal-footer">
																<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
																<a class="btn btn-warning" href="ban.php?user_id=<?php echo $fetch['user_id']?>">Confirm</a>
															</div>
														</div>
													</div>
												</div>
												
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="barangay-official" role="tabpanel" aria-labelledby="pills-barangay-official-tab">
							<div class="row p-5">
								<div class="col-lg-12">
									<button class="btn btn-success mb-3" href="#" data-toggle="modal" data-target="#addBarangayOfficial">Create new Barangay Official</button>
									<div class="table-responsive p-5 rounded" style="background-color:#fff;">
										<table id="dataTable2" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Username</th>
													<th>Password</th>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
													<th>Phone no</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$tbl_admin=$db->displayAdmin();
											
													while($fetch=$tbl_admin->fetch_array()){
														if($fetch['admin_id'] != 1){
												?>
												<tr>
													<td><?php echo $fetch['username']?></td>
													<td><?php echo str_repeat("*", 8)?></td>
													<td><?php echo $fetch['firstname']?></td>
													<td><?php echo $fetch['lastname']?></td>
													<td><?php echo $fetch['email']?></td>
													<td><?php echo $fetch['phone_no']?></td>
													<td><button class="btn btn-danger" href="#" data-toggle="modal" data-target="#removeBarangayOfficial<?php echo $fetch['admin_id']?>"><i class="fa fa-trash"></i> Remove</button></td>
												</tr>
												

												<!-- Remove Barangay Official Modal-->
												<div class="modal fade" id="removeBarangayOfficial<?php echo $fetch['admin_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
													aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">System Notification</h5>
																<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">×</span>
																</button>
															</div>
															<div class="modal-body">
																<div class="alert alert-danger">Warning!</div>
																<blockquote class="blockquote text-center">
																	<p class="mb-0 p-3">This account will be permanently deleted. <br />Are you sure you want to delete this record?</p>
																</blockquote>
															</div>
															<div class="modal-footer">
																<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
																<a class="btn btn-danger" href="deleteBarangayOfficial.php?admin_id=<?php echo $fetch['admin_id']?>">Confirm</a>
															</div>
														</div>
													</div>
												</div>
												
												<?php	
														}
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
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
	
	<!-- Create new Barangay Official Modal-->
    <div class="modal fade" id="addBarangayOfficial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<form method="POST" action="addBarangayOfficial.php">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">System Notification</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<h6 class="alert alert-success mb-5">Create new Barangay Official</h6>
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Enter username" required="required"/>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Enter password" required="required"/>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="firstname" placeholder="Enter firstname" required="required"/>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="lastname" placeholder="Enter lastname" required="required"/>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Enter email" required="required"/>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" name="phone_no" placeholder="Phone no" required="required"/>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary" name="create">Confirm</button>
					</div>
				</form>
            </div>
        </div>
    </div>
	
	
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
	
	<!-- Data Tables -->
    <script src="../js/jquery.dataTables.js"></script>
    <script src="../js/dataTables.bootstrap4.js"></script>
	<script>
		$(document).ready(function(){
			$('#dataTable').DataTable();
			$('#dataTable2').DataTable();
		})
	</script>
	
    <!-- Core plugin JavaScript-->
    <script src="../js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>