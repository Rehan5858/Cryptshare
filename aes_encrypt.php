<?php 

session_start();

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// function sendMail($em,$op,$fn){
//     require ("PHPMailer/PHPMailer.php");
//     require ("PHPMailer/SMTP.php");
//     require ("PHPMailer/Exception.php");

//     $mail = new PHPMailer(true);

//     try {
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->Username   = 'rezzeroinfo@gmail.com';                     //SMTP username
//         $mail->Password   = 'zeroinfo0';                               //SMTP password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//         $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
//         //Recipients
//         $mail->setFrom('rezzeroinfo@gmail.com', 'cryptshare');
//         $mail->addAddress($em);     //Add a recipient
    
//         //Content
//         $mail->isHTML(true);                                  //Set email format to HTML
//         $mail->Subject = 'AES file Received';
//         $mail->Body    = 'Your AES file name : '.$fn.'<br>FILE KEY : <b>'.$op.'</b>';
    
//         $mail->send();
//         header("location:verify.php");
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }

// function random_str($length,$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') 
// {
//     $str = '';
//     $max = mb_strlen($keyspace, '8bit') - 1;
//     if ($max < 1) {
//         throw new Exception('$keyspace must be at least two characters long');
//     }
//     for ($i = 0; $i < $length; ++$i) {
//         $str .= $keyspace[random_int(0, $max)];
//     }
//     return $str;
// }

$myfile = fopen("media/".$_SESSION['r_id']."/".$_SESSION['filen']."", "r") or die("Unable to open file!");
// $myfile = fopen("media/".$_SESSION['e_id']."/11953-demo.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $data = fgets($myfile);
}
fclose($myfile);


$password = $_SESSION['r_pass'];
$method = "AES-256-CBC";
$key = hash('sha256', $password, true);
$iv = openssl_random_pseudo_bytes(16);

// sendMail($_SESSION['remail'], $password, $_SESSION['filen']);

$ciphertext = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
$hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);

$encrypted_data = $iv . $hash . $ciphertext;

$myfile = fopen("media/".$_SESSION['r_id']."/".$_SESSION['filen']."", "w") or die("Unable to open file!");
fwrite($myfile, $encrypted_data);
fclose($myfile);

unset($_SESSION['filen']);
unset($_SESSION['remail']);
unset($_SESSION['r_id']);
unset($_SESSION['r_pass']);
header('location:home.php');

?>