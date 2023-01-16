<?php

session_start();

if(!isset($_SESSION['name'])){
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="index.css" />
	<link rel="stylesheet" type="text/css" href="signin.css" />
</head>
<body>

<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "mydata";

$con = mysqli_connect($server, $username, $password, $db);

if(!$con){
    die("connection to this database failed due to".mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $new_pass = $_POST['np'];
    $confirm_pass = $_POST['cnp'];

    if($new_pass==$confirm_pass){
        $new_pass = password_hash($new_pass,PASSWORD_DEFAULT);
        $pass_update = "UPDATE `users` SET `pass`='$new_pass' where email='".$_SESSION['email']."';";
        $query = mysqli_query($con,$pass_update);
        header("location:logout.php");
        }
    else{
        ?>
        <script>
            alert("Confirm Password is Wrong!!!!!!!!!");
        </script>
        <?php
    }
}

?>

    <div class="container-fluid banner">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-md">
					<div class="navbar-brand">CRYPTSHARE</div>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="index.html">HOME</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.html">ABOUT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">CONTACT</a>
						</li>
					</ul>
				</nav>
			</div>
			<section class="wrapper">
                <div class="container">
                    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-2">Setup New Password</h3>
                            <div class="fw-normal text-muted mb-4">
                                Already have reset your password ? <a href="cancel.php" class="text-primary fw-bold text-decoration-none">LogIn</a>
                            </div>
                              <div class="form-floating mb-4">
                                <input name="np" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                <span class="password-info mt-2">Use 8 or more characters with a mix of letters, numbers & symbols.</span>
                              </div>
                              <div class="form-floating mb-3">
                                <input name="cnp" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Confirm Password</label>
                              </div>
                              <!-- <div class="form-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox" id="gridCheck" checked>
                                  <label class="form-check-label ms-2" for="gridCheck">
                                      I Agree <a href="#">Terms and conditions</a>
                                  </label>
                              </div> -->
                              
                              <button name="submit" type="submit" class="btn btn-primary submit_btn my-4">Submit</button>
                              
                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>
</body>
</html>