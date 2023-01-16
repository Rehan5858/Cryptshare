<?php

session_start();

if(!isset($_SESSION['name'])){
	header('location:login.php');
}
include('Crypt/RSA.php');
include "config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stat = $db->prepare("select * from newfiles where id=?");
    $stat->bindParam(1,$id);
    $stat->execute();
    $data = $stat->fetch();

    if($data['algorithm']=="NONE"){
        $file = "media/".$_SESSION['e_id']."/".$data['filename'];

        if(file_exists($file)){
            header('Content-Description: '.$data['description']);
            header('Content-Type: '.$data['type']);
            header('Content-Disposition: '.$data['disposition'].'; filename="'.basename($file).'"');
            header('Expires: '.$data['expires']);
            header('Catch-Control: '.$data['cache']);
            header('Pragma: '.$data['pragma']);
            header('Content-Length: '.filesize($file));
            readfile($file);
            exit;
        }
    }

    if($data['algorithm']=="AES"){
        $file = "media/".$_SESSION['e_id']."/".$data['filename'];

        copy("media/".$_SESSION['e_id']."/".$data['filename'],"media/".$_SESSION['e_id']."/temp/".$data['filename']);
        
        $myfile = fopen("media/".$_SESSION['e_id']."/temp/".$data['filename']."", "r") or die("Unable to open file!");
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

        $myfile = fopen("media/".$_SESSION['e_id']."/temp/".$data['filename']."", "w") or die("Unable to open file!");
        fwrite($myfile, $decrypted_data);
        fclose($myfile);

        $file1 = "media/".$_SESSION['e_id']."/temp/".$data['filename'];
        if(file_exists($file1)){
            header('Content-Description: '.$data['description']);
            header('Content-Type: '.$data['type']);
            header('Content-Disposition: '.$data['disposition'].'; filename="'.basename($file1).'"');
            header('Expires: '.$data['expires']);
            header('Catch-Control: '.$data['cache']);
            header('Pragma: '.$data['pragma']);
            header('Content-Length: '.filesize($file1));
            readfile($file1);
            unlink("media/".$_SESSION['e_id']."/temp/".$data['filename']);
            exit;
        }
    }

    if($data['algorithm']=="RSA"){

        $server = "localhost";
        $username = "root";
        $password = "";
        $db = "mydata";

        $conn = mysqli_connect($server, $username, $password, $db);

        $key_search = "SELECT * FROM `crypt_keys` where e_id='".$_SESSION['e_id']."';";
        $query = mysqli_query($conn,$key_search);
        $key_id = mysqli_fetch_assoc($query);
        $priv_key = $key_id['private_key'];

        $file = "media/".$_SESSION['e_id']."/".$data['filename'];

        copy("media/".$_SESSION['e_id']."/".$data['filename'],"media/".$_SESSION['e_id']."/temp/".$data['filename']);
        
        $myfile = fopen("media/".$_SESSION['e_id']."/temp/".$data['filename']."", "r") or die("Unable to open file!");
        // Output one line until end-of-file
        while(!feof($myfile)) {
        $ciphertext = fgets($myfile);
        }
        fclose($myfile);

        $rsa = new Crypt_RSA();

        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $rsa->loadKey($priv_key); // private key
        $decrypted_data = $rsa->decrypt($ciphertext);

        $myfile = fopen("media/".$_SESSION['e_id']."/temp/".$data['filename']."", "w") or die("Unable to open file!");
        fwrite($myfile, $decrypted_data);
        fclose($myfile);

        $file1 = "media/".$_SESSION['e_id']."/temp/".$data['filename'];
        if(file_exists($file1)){
            header('Content-Description: '.$data['description']);
            header('Content-Type: '.$data['type']);
            header('Content-Disposition: '.$data['disposition'].'; filename="'.basename($file1).'"');
            header('Expires: '.$data['expires']);
            header('Catch-Control: '.$data['cache']);
            header('Pragma: '.$data['pragma']);
            header('Content-Length: '.filesize($file1));
            readfile($file1);
            unlink("media/".$_SESSION['e_id']."/temp/".$data['filename']);
            exit;
        }
    }
}

?>