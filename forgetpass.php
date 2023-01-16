<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($em,$op){
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rezzeroinfo@gmail.com';                     //SMTP username
        $mail->Password   = 'zeroinfo0';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('rezzeroinfo@gmail.com', 'cryptshare');
        $mail->addAddress($em);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'OTP Verification';
        $mail->Body    = 'this is your otp : <b>'.$op.'</b>';
    
        $mail->send();
        header("location:verify.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="signin.css">
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

    $email_search = "SELECT * FROM `users` where email='$email';";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['pass'];
        
        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['email'] = $email_pass['email'];

        $otp = rand(100000,999999);

        $_SESSION['otp'] = $otp;

        sendMail($email, $otp);

        
    }
    else{
        ?>
            <script>
                alert("Entered Email is Incorrect");
            </script>
        <?php
    }
}

// function smtp_mailer($to,$subject,$msg){

//     require_once("smtp/class.phpmailer.php");
//     $mail = new PHPMailer();
//     $mail -> IsSMTP();
//     $mail -> SMTPDebug = 1;
//     $mail -> SMTPAuth = true;
//     $mail -> SMTPSecure = 'TLS';
//     $mail -> Host = "smtp.sendgrid.net";
//     $mail -> Port = 587;
//     $mail -> IsHTML(true);
//     $mail -> CharSet = 'UTF-8';
//     $mail -> Username = "rezzeroinfo@gmail.com";
//     $mail -> Password = "zeroinfo0";
//     $mail -> SetFrom("rezzeroinfo@gmail.com");
//     $mail -> Subject = $subject;
//     $mail -> Body = $msg;
//     $mail -> AddAddress($to);
//     if(!$mail->Send()){
//         return 0;
//     }else{
//         return 1;
//     }

// }

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
                            <h3 class="text-dark fw-bolder fs-4 mb-2">Forget Password?</h3>
                            <div class="fw-normal text-muted mb-4">
                                Enter your email to reset your password.
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                              </div>
                              <button type="submit" name="submit" class="btn btn-primary submit_btn my-4">Submit</button>
                              <a href="login.php"><button type="button" class="btn btn-secondary submit_btn my-4 ms-3">Cancel</button></a>
                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>
</body>
</html>