<<<<<<< HEAD
<link href="../static/css/animation.css" rel="stylesheet" />
<body translate="no" >
  <div class="loader"></div>
<?php
$url = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if($action == 'report'){
        $_SESSION['report'] = $_GET['reports'];
        $url = 'Location:../public/BookReport.php';
    }
    header($url);
}
?>
</body>
=======
<?php
$url = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if($action == 'report'){
        $_SESSION['report'] = $_GET['reports'];
        $url = 'Location:../public/BookReport.php';
    }
    echo $_GET['reports'];
    header($url);
}
?>
>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
