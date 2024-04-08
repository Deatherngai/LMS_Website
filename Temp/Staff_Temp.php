<<<<<<< HEAD
<link href="../static/css/animation.css" rel="stylesheet" />
<body translate="no" >
  <div class="loader"></div>
=======

>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
<?php
$url = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    $Info = $_GET['info'];
    $_SESSION['Staff_info'] = $Info;
    $stInfo = json_decode($Info,true);
    $LID = $stInfo[0]['LID'];
    switch($action){
        case 'stock':
            $url = 'Location:../DBQuery/StockQuery.php?action='.$action.'&lid='.$LID;
            break;
        case 'loan':
            $url = 'Location:../DBQuery/LoanRecordQuery.php?action='.$action.'&lid='.$LID;
            break;
        case 'r_records':
            $url = 'Location:../DBQuery/LibraryQuery.php?action='.$action;
            break;
        default:
            $url='';
            break;
    }
    header($url);
}
?>
<<<<<<< HEAD
</body>
=======
>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
