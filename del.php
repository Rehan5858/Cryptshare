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

    unlink("media/".$_SESSION['e_id']."/".$data['filename']);

    $stat = $db->prepare("DELETE from newfiles where id=?");
    $stat->bindParam(1,$id);
    $stat->execute();

    header('location:receive.php');
}

?>