<?php
session_start();
$_SESSION['login'] = "false";
$_SESSION['Account'] = "";
header("Location:../index2.php");