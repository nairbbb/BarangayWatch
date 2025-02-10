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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
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
					<div class="alert alert-primary">BARANGAY NEWS & UPDATES</div>
					
					<div class="row p-3">
						<div class="col-lg-8">
							<div class="col-lg-12 p-4">
								<div class="card card-body bg-light">
									<?php 
										if(ISSET($_REQUEST['news_id']) && $_REQUEST['news_id'] != null){
											$news_id=$_REQUEST['news_id'];
											$tbl_news=$db->displaySingleNews($news_id);
											$fetch=$tbl_news->fetch_array();
									?>
										<h1 class="text-dark"><?php echo $fetch['title']?></h1>
										<small><?php echo $fetch['firstname']." ".$fetch['lastname']?></small>
										<small><?php echo "Published ".date("M d, Y h:i A", strtotime($fetch['date_created']))?></small>
										<hr/>
										<p class="lead m-3"><?php echo $fetch['post']?></p>
									<?php
										}else if(!ISSET($_REQUEST['news_id']) || $_REQUEST['news_id'] == null){
											echo "<h2>NO DATA FOUND!</h2>";
										}
									?>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="col-lg-12 p-4">
								<div class="card card-body bg-light">
									<h6>NEWS & UPDATE</h6>
									<div class="list-group mt-4">
										<?php
											$tbl_news=$db->displayNews();
											
											while($fetch=$tbl_news->fetch_array()){
										
										?>
										<a href="viewNewsPost.php?news_id=<?php echo $fetch['news_id'];?>" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="d-flex w-100 justify-content-between">
												<h5 class="mb-1 text-primary" style="text-overflow: ellipsis; overflow: hidden;"><?php echo $fetch['title']?></h5>
											</div>
											<p class="mb-1 p-1">
												<?php 
													$post =  mb_strimwidth($fetch['post'], 0, 90, "..."); 
													echo $post; 
												
												?>
											</p>
											<small class="float-left"><?php echo $db->get_time_ago($fetch['date_created'])?></small>
											<small class="float-right"><?php echo $fetch['firstname']." ".$fetch['lastname']?></small>
										</a>
										<?php
											}
											$row=$tbl_news->num_rows;
											if($row>0){
										?>
											<a style="text-decoration:none;" href="newsList.php" class="text-muted d-flex justify-content-center mt-2">Read more</a>
										<?php
											}
										?>
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

    <!-- Core plugin JavaScript-->
    <script src="../js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>