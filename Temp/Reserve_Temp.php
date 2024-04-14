<?php
ob_clean();
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
    }else if($action == 'r_record'){
        $_SESSION['r_records'] = $_GET['records'];
        $records = json_decode($_SESSION['r_records'],true);
        if(count($records)>0){
            $_SESSION['rn']=1;
            unset($_SESSION['r_books']);
            $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$records[0]['ISBN'];
        }else{
            $url = 'Location:../public/ReserveRecords.php';
        }
    }else if($action == 'r_records'){
        $_SESSION['r_records'] = $_GET['records'];
        $records = json_decode($_SESSION['r_records'],true);
        if(count($records)>0){
            $_SESSION['rn']=1;
            unset($_SESSION['r_books']);
            DividArea($records);
            $lib = json_decode($_SESSION['library_all'],true);
            for($i=0;$i<count($lib);$i++){
                $cur = $lib[$i]['LID'].'_resever';
                $isbn = "";
                if(isset($_SESSION[$cur]) && $_SESSION[$cur] != []){
                    $list = json_decode($_SESSION[$cur],true);
                    $isbn = $list[0]['ISBN'];
                    $_SESSION['rrn'] = $i;
                    $_SESSION['item_n'] = 1;
                    $i = count($lib)+1;
                }
            }
            $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
        }else{
            $url = 'Location:../public/ReserveRecords.php';
        }
    }
}
function DividArea($arr){
    $lib_n = json_decode($_SESSION['library_all'],true);
    $lib_arr = [];
    $len = count($lib_n);
    for($i=0;$i<$len;$i++){
        $lib_arr[$i] = [];
    }
    for($k=0;$k<count($arr);$k++){
        for($y=0;$y<$len;$y++){
            if($lib_n[$y]['LID'] == $arr[$k]['LID']){
                array_push($lib_arr[$y],$arr[$k]);
                $y = $len + 1;
            }
        }
    }
    for($h=0;$h<$len;$h++){
        $target = $lib_n[$h]['LID'].'_resever';
        $_SESSION[$target] = json_encode($lib_arr[$h]); 
    }
}
header($url);
exit;
?>
