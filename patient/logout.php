<?php
session_start();
// include_once('controller/dbconn.php');
// date_default_timezone_set("Asia/Kolkata"); 
// $logoutTym=gosql("UPDATE `login` SET `logout_tym`= '".date("Y-m-d H:i:s")."' WHERE `username`= '".$_SESSION["Admin"]["username"]."';");
//Free session variables
// session_unset();
// destroy the session
session_destroy();
unset($_SESSION["Admin"]);
header("Location:index.php");
?>