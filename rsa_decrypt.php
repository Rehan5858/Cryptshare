<?php 

session_start();
include('Crypt/RSA.php');

$server = "localhost";
$username = "root";
$password = "";
$db = "mydata";

$conn = mysqli_connect($server, $username, $password, $db);

$key_search = "SELECT * FROM `crypt_keys` where e_id='".$_SESSION['e_id']."';";
$query = mysqli_query($conn,$key_search);
$key_id = mysqli_fetch_assoc($query);
$priv_key = $key_id['private_key'];

$myfile = fopen("media/".$_SESSION['e_id']."/29616-8821-demo.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
    $ciphertext = fgets($myfile);
}
fclose($myfile);

echo $ciphertext."<br>".$priv_key."<br>";

$rsa = new Crypt_RSA();
$rsa->loadKey($priv_key); // private key
$decrypted_data = $rsa->decrypt($ciphertext);

// $myfile = fopen("media/".$_SESSION['e_id']."/temp/".$data['filename']."", "w") or die("Unable to open file!");
// fwrite($myfile, $decrypted_data);
// fclose($myfile);

echo $decrypted_data;

?>