<?php
if(isset($_POST['fn'])){
    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password);

    if(!$con){
        die("connection to this database failed due to".mysqli_connect_error());
    }
    //echo "Success conecting to the db";

    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $ea = $_POST['ea'];
    $msg = $_POST['msg'];

    $sql = "INSERT INTO `mydata`.`contactus` (`firstname`, `lastname`, `email`, `msg`) VALUES ('$fn', '$ln', '$ea', '$msg');";
    //echo $sql;

    if($con->query($sql) == true){
      //  echo "Successfully inserted";
    }
    else{
      //  echo "ERROR : $sql <br> $con->error";
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="contact.css" />
</head>
<body>
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
							<a class="nav-link" href="#">CONTACT</a>
						</li>
					</ul>
				</nav>
			</div>

			<div class="col-lg-6 py-5 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="head text-center text-white py-3">
                                    <h3>Contact Us</h3>
                                </div>
                            </div>
                        </div>
                        <form action="contact.php" method="post">
                        <div class="form p-3">
                            <div class="form-row my-2 pt-4">
                                <div class="col-lg-12">
                                    <input type="text" name="fn" id="fn" class="effect-1" placeholder="First Name">
                                    <span class="Focus-border"></span>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <input type="text" name="ln" id="ln" class="effect-1" placeholder="Last Name">
                                    <span class="Focus-border"></span>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                        <input type="text" name="ea" id="ea" class="effect-1" placeholder="Email Address">
                                        <span class="Focus-border"></span> 
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <input type="text" name="msg" id="msg" class="effect-1" placeholder="Your Message">
                                    <span class="Focus-border"></span>
                                </div>
                                <br>
                                <div class="offset-5 col-lg-4">
                                    <button class="btn1">Send Message</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</body>
</html>