<link href="../static/css/animation.css" rel="stylesheet" />
<body translate="no" >
  <div class="loader"></div>
<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
  $action = $_GET['action'];
  if($action == 'report'){
      $_SESSION['report'] = $_GET['reports'];
      echo count(json_decode($_SESSION['report'],true));
      $url = 'Location:../public/BookReport.php';
  }
  header($url);
}
?>
</body>
