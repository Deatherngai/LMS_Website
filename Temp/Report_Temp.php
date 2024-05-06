<link href="../static/css/animation.css" rel="stylesheet" />
<?php
ob_clean();
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
  $action = $_GET['action'];
  if($action == 'report'){
      $_SESSION['report'] = $_GET['reports'];
      $url = "Location:../public/AccInfo.php";
  }
  header($url);
  exit;
}
?>
