<?php

session_start();

if(!isset($_SESSION['name'])){
	header('location:login.php');
}

$server = "localhost";
$username = "root";
$password = "";
$db = "mydata";

$conn = mysqli_connect($server, $username, $password, $db);

if(isset($_POST['upload']))
{
    $rname = $_POST['receiver'];
    $receiver_search = "SELECT * FROM `users` where name='$rname';";
    $query = mysqli_query($conn,$receiver_search);
    $receiver_id = mysqli_fetch_assoc($query);
    $receiver = $receiver_id['e_id'];
    $_SESSION['remail'] = $receiver_id['email'];
    $_SESSION['r_id'] = $receiver_id['e_id'];
    $_SESSION['r_pass'] = $receiver_id['pass'];
    $_SESSION['r_pubkey'] = $receiver_id['public_key'];


    $file = rand(1000, 100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "media/".$receiver."/";
    $algo = $_POST['flexRadioDefault'];
    $receiver = $_POST['receiver'];

    $new_size = $file_size/1024;

    $new_file_name = strtolower($file);

    $final_file = str_replace(' ','-',$new_file_name);

    date_default_timezone_set('Asia/Kolkata');
    $d = date('m-d-Y');
    $t = date('h:i:sa');
    
    $_SESSION['filen'] = $final_file;
    if($algo == "NONE"){
        if(move_uploaded_file($file_loc,$folder.$final_file))
        {
            $sql="INSERT INTO `newfiles`(`filename`, `type`, `description`, `disposition`, `expires`, `cache`, `pragma`, `sendername`, `algorithm`, `size`, `receivername`, `date`, `time`) VALUES ('$final_file','$file_type','File Transfer','attachment','0','must-revalidate','private','".$_SESSION['name']."','$algo','$new_size','$receiver','$d','$t')";

            mysqli_query($conn,$sql);

            header('location:home.php');
        }
        else
        {
            echo "error";
        }
    }
    if($algo == "AES"){
        if(move_uploaded_file($file_loc,$folder.$final_file))
        {
            $sql="INSERT INTO `newfiles`(`filename`, `type`, `description`, `disposition`, `expires`, `cache`, `pragma`, `sendername`, `algorithm`, `size`, `receivername`, `date`, `time`) VALUES ('$final_file','$file_type','File Transfer','attachment','0','must-revalidate','private','".$_SESSION['name']."','$algo','$new_size','$receiver','$d','$t')";

            mysqli_query($conn,$sql);

            header('location:aes_encrypt.php');
        }
        else
        {
            echo "error";
        }
    }
    if($algo == "RSA"){
        if(move_uploaded_file($file_loc,$folder.$final_file))
        {
            $sql="INSERT INTO `newfiles`(`filename`, `type`, `description`, `disposition`, `expires`, `cache`, `pragma`, `sendername`, `algorithm`, `size`, `receivername`, `date`, `time`) VALUES ('$final_file','$file_type','File Transfer','attachment','0','must-revalidate','private','".$_SESSION['name']."','$algo','$new_size','$receiver','$d','$t')";

            mysqli_query($conn,$sql);

            header('location:rsa_encrypt.php');
        }
        else
        {
            echo "error";
        }
    }
}

?>