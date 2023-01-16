<?php

session_start();

if(!isset($_SESSION['name'])){
	header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files to Download</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="signin.css">
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
							<a class="nav-link" href="profile.php">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Log Out</a>
						</li>
					</ul>
				</nav>
			</div>
			<section class="wrapper">
                <div class="container">
                    <div class="text-center">
                        <form class="rounded bg-white shadow p-5">
                        <h3 class="text-dark fw-bolder fs-4 mb-2">CRYPTSHARE</h3>
                        <p><br></p>
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <!-- <th>File Id</th> -->
                                        <th>Sender Name</th>
                                        <th>Algorithm</th>
                                        <th>File Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        include "config.php";
                                        $stmt = $db->prepare("select * from newfiles where receivername='".$_SESSION['name']."';");
                                        $stmt->execute();
                                        while($row = $stmt->fetch()){
                                    ?>
                                    <tr>
                                        <!-- <td><?php echo $row['id'] ?></td> -->
                                        <td><?php echo $row['sendername'] ?></td>
                                        <td><?php echo $row['algorithm'] ?></td>
                                        <td><?php echo $row['filename'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php echo $row['time'] ?></td>
                                        <td class="text-center">
                                            <a href="download.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Download</a>
                                            <a href="del.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>

</body>
</html>