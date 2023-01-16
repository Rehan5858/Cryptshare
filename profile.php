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
		Profile Page
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="index.css" />

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css"
    rel="stylesheet"
    />
</head>
<body>
	<div class="container-fluid banner">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-md">
					<div class="navbar-brand">CRYPTSHARE</div>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="home.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Log Out</a>
						</li>
					</ul>
				</nav>
			</div>
        </div>
	</div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
                <div class="row z-depth-3">
                    <div class="col-sm-4 bg-info rounded-left">
                        <div class="card-block text-center text-white"><br><br><br>
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <h2 class="font-weight-bold mt-4"><?php echo $_SESSION['name']; ?></h2>
                            <p><?php echo $_SESSION['role']; ?></p>
                            <!-- <i class="far fa-edit fa-2x mb-4"></i> -->
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white rounded-right">
                        <h3 class="mt-3 text-center">Information</h3>
                        <hr class="badge-primary mt-0 w-25">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Email:</p>
                                <h6 class="text-muted"><?php echo $_SESSION['email']; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Phone:</p>
                                <h6 class="text-muted"><?php echo $_SESSION['mob']; ?></h6>
                            </div>
                        </div><br>
                        <h4 class="mt-3">Company Status</h4>
                        <hr class="bg-primary">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Employee Id:</p>
                                <h6 class="text-muted"><?php echo $_SESSION['e_id']; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Branch:</p>
                                <h6 class="text-muted"><?php echo $_SESSION['branch']; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <br><p class="font-weight-bold">Public Key:</p>
                                <h6 class="text-muted"><?php echo $_SESSION['pub_key']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
</body>
</html>