<?php
session_start();
$k=1;
$n = 1;
$len = 0;
$lid="";
$stock=[];
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action=$_GET['action'];
    if($action == 'BQ'){
        $n = (int)$_GET['n'];
        if($n==1){
            $_SESSION['library'] = urldecode($_GET['library']);
        }else{
            $_SESSION['library'] =$_SESSION['library'].','.urldecode($_GET['library']);
        }
        $stock = json_decode($_SESSION['stock'],true);
        $len = count($stock);
        if(isset($_GET['n'])){
            $n = $_GET['n'];
        }
        if($n<$len){
            $lid = $stock[$n-1]['LID'];
            $url = 'Location:../DBQuery/LibraryQuery.php?action='.$action.'&lid='.$lid.'&n=1';
        }else{
            $_SESSION['library'] ='['.$_SESSION['library'].']';
            $url = 'Location:../public/B_info.php';
        }
    }else if($action == 'AllStock'){
        $_SESSION['library_all'] = urldecode($_GET['library']);
        $url = 'Location:../DBQuery/StockQuery.php?action='.$action;
    }else if($action == 'loan_all'){
        $_SESSION['library_all'] = urldecode($_GET['library']);
        $url = 'Location:../DBQuery/LoanRecordQuery.php?action='.$action;
    }
    header($url);
}
?>
<link href="../static/css/animation.css" rel="stylesheet">
<body translate="no" >
  <div class="loader"></div>
</body>