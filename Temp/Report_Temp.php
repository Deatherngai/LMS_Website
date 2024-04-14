<?php
ob_clean();
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
  $action = $_GET['action'];
  if($action == 'report'){
      $_SESSION['report'] = $_GET['reports'];
      $url = 'Location:../public/BookReport.php';
  }
  header($url);
  exit;
}
?>
