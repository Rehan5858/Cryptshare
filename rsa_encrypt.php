<?php 

session_start();

include('Crypt/RSA.php');

$myfile = fopen("media/".$_SESSION['r_id']."/".$_SESSION['filen']."", "r") or die("Unable to open file!");
// $myfile = fopen("media/".$_SESSION['e_id']."/11953-demo.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $data = fgets($myfile);
}
fclose($myfile);

$rsa = new Crypt_RSA();
$rsa->loadKey($_SESSION['r_pubkey']); // public key


$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
$ciphertext = $rsa->encrypt($data);

$myfile = fopen("media/".$_SESSION['r_id']."/".$_SESSION['filen']."", "w") or die("Unable to open file!");
fwrite($myfile, $ciphertext);
fclose($myfile);

unset($_SESSION['filen']);
unset($_SESSION['remail']);
unset($_SESSION['r_id']);
unset($_SESSION['r_pass']);
unset($_SESSION['r_pubkey']);
header('location:home.php');

?>