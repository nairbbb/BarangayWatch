<!DOCTYPE html>
<?php
	session_start();
	
	require_once'class.php';
	
	$db = new db_class();
	
	if(!ISSET($_SESSION['admin_id'])){
		echo"<script>window.location='index.php'</script>";
	}

?>
<html lang="en" ng-app="myModule">

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

<body ng-controller="myController">

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
						<div class="col-lg-12">
							<div class="col-lg-12 p-4">
								<div class="card card-body bg-light">
									<h6>NEWS & UPDATE</h6>
									<div class="list-group mt-4">
										<a dir-paginate="news in news|itemsPerPage:10" href="viewNewsPost.php?news_id={{news.news_id}}" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="d-flex w-100 justify-content-between">
												<h5 class="mb-1 text-primary" style="text-overflow: ellipsis; overflow: hidden;">{{news.title}}</h5>
											</div>
											<p class="mb-1 p-1">{{news.post}}</p>
											<small class="float-left">{{news.date_created}}</small>
											<small class="float-right">{{news.firstname}} {{news.lastname}}</small>
										</a>
									</div>
									<br />
								
									<dir-pagination-controls boundary-links="true" template-url="../admin/dirPagination.tpl.html"></dir-pagination-controls>
						
									
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
    <script src="../js/angular.js"></script>
    <script src="../js/dirPagination.js"></script>
    <script src="../js/script.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>