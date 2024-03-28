<?php
$url = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if(isset($_GET['exist'])){
        $_SESSION['id_exist'] = $_GET['exist'];
        $_SESSION['R_ID'] = $_GET['R_ID'];
    }
    if($action == 'Reserve'){
        $url = 'Location:../DBQuery/ReserveQuery.php?action='.$action;
    }
}
?>
<link href="../static/css/animation.css" rel="stylesheet">
<body translate="no" >
  <div class="loader"></div>
</body>