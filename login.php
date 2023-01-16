<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

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
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = "SELECT * FROM `users` where email='$email';";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['pass'];
        

        // $pass_decode = password_verify($password, $db_pass);

        // if($pass_decode){
        if(password_verify($password,$db_pass)){
            $_SESSION['name'] = $email_pass['name'];
            $_SESSION['email'] = $email_pass['email'];
            $_SESSION['mob'] = $email_pass['mob'];
            $_SESSION['branch'] = $email_pass['branch'];
            $_SESSION['e_id'] = $email_pass['e_id'];
            $_SESSION['role'] = $email_pass['role'];
            $_SESSION['pass'] = $email_pass['pass'];
            $_SESSION['pub_key'] = $email_pass['public_key'];
            ?>
            <script>
                location.replace("home.php");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Entered Password is Wrong");
            </script>
            <?php
        }
    }
    else{
        ?>
            <script>
                alert("Entered Email is Incorrect");
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
							<a class="nav-link" href="contact.php">CONTACT</a>
						</li>
					</ul>
				</nav>
			</div>
			<section class="wrapper">
                <div class="container">
                    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-4">Login</h3>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                              </div>
                              <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                              </div>
                              <div class="mt-2 text-end">
                                  <a href="forgetpass.php" class="text-primary fw-bold text-decoration-none">Forget Password?</a>
                              </div>
                              <button type="submit" name="submit" class="btn btn-primary submit_btn w-100 my-4">Continue</button>
                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>
</body>
</html>