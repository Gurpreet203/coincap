<?php
    session_start();
    unset($_SESSION['login']);
    if(!isset($_SESSION['coin']))
    {
        header("location:index.php");
    }
    header('location:../index.php');
?>