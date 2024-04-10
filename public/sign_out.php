<?php
session_start();
$_SESSION['login'] = "false";
$_SESSION['Account'] = "";
unset($_SESSION['login2']);
header("Location:../index2.php");