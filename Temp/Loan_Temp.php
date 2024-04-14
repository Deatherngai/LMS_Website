<?php
session_start();
ob_clean();
$action = '';
$records='';
$url = '';
$n = 0;
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $action = $_GET['action'];
    if($_GET['records'] != ''){
        $_SESSION['records'] = $_GET['records'];
        unset($_SESSION["books"]);
        unset($_SESSION['loan_stock']);
        $records = json_decode($_SESSION['records'],true);
        $n = count($records);
        $_SESSION['loan_n']=0;
        $_SESSION['loan_tn']=$n;
        $_SESSION['r'].=$records[0]['BID'];
        $url = 'Location:../DBQuery/StockQuery.php?action='.$action.'&BID='.$records[0]['BID'];
    }else{
        $url = '';
    }
    header($url);
    exit;
}
?>
