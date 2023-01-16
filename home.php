<?php

session_start();

if(!isset($_SESSION['name'])){
	header('location:login.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewreport" content="width=device-width, initial-scale=1.0">
	<title>
		Home Page
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
	<div class="container-fluid banner">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-md">
					<div class="navbar-brand">CRYPTSHARE</div>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="#">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profile.php">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Log Out</a>
						</li>
					</ul>
				</nav>
			</div>
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center align-items-center">
                <br><br><br><br><br><br>
                    <h1><?php echo $_SESSION['name']; ?></h1>
                    <a href="send.php"><button type="button" class="btn btn-success btn-lg p-4  my-4">Send</button></a>
                    <a href="receive.php"><button type="button" class="btn btn-secondary btn-lg p-4 my-4 ms-4">Receive</button></a>
            </div>
               
                
		</div>
	</div>
</body>
</html>