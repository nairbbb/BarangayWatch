<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BarangayWatch</title>

    <!-- Custom fonts for this template-->
    <link href="../css/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>

    <div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
			<a class="navbar-brand" href="#">
				<img src="../img/logo.jpg" width="30" height="30" alt="" style="border-radius:20px;"> BarangayWatch
			</a>
		</nav>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
				<div class="p-5 rounded mt-5">
					<div class="row">
						<div class="col-lg-5">
						<img src="../img/login.png" class="bg-admin-login d-none d-lg-block"/>
						</div>
						<div class="col-lg-2"></div>
						<div class="col-lg-5">
								<div class="text-center">
									<h1 class="h5 mb-5 text-light">Welcome to BarangayWatch Control</h1>
								</div>
								<form method="POST" action="adminLogin.php" class="user">
									<div class="form-group">
										<input type="text" class="form-control" name="username" placeholder="Enter Username" maxlength="30"/>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="password" placeholder="Enter Password" />
									</div>
									<br />
									
									<?php 
										session_start();
										if(ISSET($_SESSION['message'])){
											echo"<div class='alert alert-danger text-center'>";
											echo "<span'>".$_SESSION['message']."</span>";
											echo "</div>";
										}
									?>
									
									<button name="login" class="btn btn-primary btn-block">Login</button>
								</form>
							
						</div>
					</div>
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