<?php 

session_start();

$myfile = fopen("media/".$_SESSION['e_id']."/".$_SESSION['filen']."", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $ivHashCiphertext = fgets($myfile);
}
fclose($myfile);

$password = $_SESSION['pass'];
$method = "AES-256-CBC";
$iv = substr($ivHashCiphertext, 0, 16);
$hash = substr($ivHashCiphertext, 16, 32);
$ciphertext = substr($ivHashCiphertext, 48);
$key = hash('sha256', $password, true);

if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
$decrypted_data = openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);

$myfile = fopen("media/".$_SESSION['e_id']."/".$_SESSION['filen']."", "w") or die("Unable to open file!");
fwrite($myfile, $decrypted_data);
fclose($myfile);
?>