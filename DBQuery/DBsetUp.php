<?php
session_start();
$_SESSION['db'] = $_GET['db'];
$_SESSION['library'] = $_GET['library'];
$_SESSION['bookDB'] = $_GET['book'];
?>