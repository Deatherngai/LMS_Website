<?php
session_start();
include('includes/file_path.php');
include('dbcon.php');
$book = $_POST['book'];
echo "<script>alert(".$book.")</script>"
?>