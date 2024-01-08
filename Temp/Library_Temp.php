<?php
session_start();
$k=1;
$n = 1;
$len = 0;
$lid="";
$stock=[];
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action=$_GET['action'];
    $n = (int)$_GET['n'];
    if($n==1){
        $_SESSION['library'] = $_GET['library'];
    }else{
        $_SESSION['library'] =$_SESSION['library'].','.$_GET['library'];
    }
    $stock = json_decode($_SESSION['stock'],true);
    $len = count($stock);
    if(isset($_GET['n'])){
        $n = $_GET['n'];
    }
    if($n<$len){
        $lid = $stock[$n-1]['LID'];
        $url = 'Location:../DBQuery/LibraryQuery.php?action='.$action.'&lid='.$lid.'&n=1';
        header($url);
    }else{
        $_SESSION['library'] ='['.$_SESSION['library'].']';
        $url = 'Location:../public/B_info.php';
        header($url);
    }
}
?>