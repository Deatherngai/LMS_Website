<?php
ob_clean();
$url = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    $_SESSION['Member_info'] = $_GET['info'];
    $url = "Location: ../public/AccInfo.php";
}
header($url);
exit;
?>
