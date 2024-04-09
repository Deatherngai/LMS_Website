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
            $url = "Location: ../public/AccInfo.php";
            break;
    }
    header($url);
}
?>
