<?php
$action = "";
$lid="";
$stock;
$record = '';
$n=0;
$tn=0;
$records = '';
$str = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if($action == 'BQ'){
        $_SESSION['stock'] = $_GET['stock'];
        $stock = json_decode($_SESSION['stock'],true);
        $lid = $stock[0]['LID'];
        echo $_SESSION['book'];
        //$url = '';
        $url = 'Location:../DBQuery/LibraryQuery.php?action='.$action.'&lid='.$lid.'&n=0';
    }else if($action == 'loan'){
        $n = (int)$_SESSION['loan_n'];
        $tn = $_SESSION['loan_tn'];
        $n+=1;
        $_SESSION['loan_n'] =$n;
        $records = json_decode($_SESSION['records'],true);
        if(isset($_SESSION['loan_stock'])){
            $record = $_GET['stock'];
            $record = str_replace('[','',$record);
            $record = str_replace(']','',$record);
            $stock = str_replace('[','',$_SESSION['loan_stock']);
            $stock = str_replace(']','',$stock);
            $_SESSION['loan_stock'] = '['.$stock.','.$record.']';
            if($n < $tn){
                $url = 'Location:../DBQuery/StockQuery.php?action='.$action.'&BID='.$records[$n]['BID'];
            }else{
                $str = QueryStock();
                $str = '['.implode(',',$str).']';
                $_SESSION['loan_isbn'] = $str;
                echo $str;
                $ISBN =json_decode($str,true);
                var_dump($ISBN);
                $_SESSION['l_b_tn'] = count($ISBN);
                $_SESSION['l_b_n'] = 0;
                $size = count($ISBN);
                if($size>0){
                    $isbn = $ISBN[0]['ISBN'];
                    $_SESSION['r']=$ISBN[0]['ISBN'];
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
                }else{
                    $url = 'Location:../User/Staff/LoanRecords.php';
                }
            }
        }else{
            $_SESSION['loan_stock']= $_GET['stock'];
            if($n < $tn){
                $url = 'Location:../DBQuery/StockQuery.php?action='.$action.'&BID='.$records[$n]['BID'];
            }else{
                $stock = json_decode($_SESSION['loan_stock'],true);
                $str = QueryStock();
                $str = '[{'.implode(',',$str).'}]';
                $_SESSION['loan_isbn'] = $str;
                $ISBN = json_decode($str,true);
                $_SESSION['l_b_tn'] = count($ISBN);
                $_SESSION['l_b_n'] = 0;
                $size = count($ISBN);
                if($size>0){
                    $isbn = $ISBN[0]['ISBN'];
                    $_SESSION['r']=$ISBN[0]['ISBN'].',';
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
                }else{
                    $url = 'Location:../User/Staff/LoanRecords.php';
                }
            }
        }
    }else{
        $_SESSION['LibStock'] = $_GET['stock'];
        $stock = json_decode($_SESSION['LibStock'],true);
        $isbn = $stock[0]['ISBN'];
        $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
        echo $_SESSION['LibStock'];
    }
    header($url);
}

function QueryStock(){
    $st_info =  json_decode($_SESSION['Staff_info'],true);
    $stock = json_decode($_SESSION['loan_stock'],true);
    $loan_rd = json_decode($_SESSION['records'],true);
    $lib = $st_info[0]['LID'];
    $len = count($loan_rd);
    $str = array();
    $loan = array();
    for($x=0;$x<$len;$x++){
        if($lib == $stock[$x]['LID']){
            array_push($str,'{"ISBN":'.$stock[$x]['ISBN'].'}');
            $str2 ='{"AccID":'.'"'.$loan_rd[$x]['AccID'].'"'.','.'"BorrowingType":'.'"'.$loan_rd[$x]['BorrowingType'].'",'.'"ExpiryDate":'.'"'.date("Y-m-d",$loan_rd[$x]['ExpiryDate']['seconds']).'"'.','.'"ExpiryDate":'.'"'.date("Y-m-d",$loan_rd[$x]['ExpiryDate']['seconds']).'"}';
            array_push($loan,$str2);
        }
    }
    $_SESSION['loan_stock'] = '['.implode(',',$loan).']';
    return $str;
}
?>