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
        $url = 'Location:../DBQuery/LibraryQuery.php?action='.$action.'&lid='.$lid.'&n=0';
    }else if($action == 'record' || $action == 'history'){
        $n = (int)$_SESSION['loan_n'];
        $tn = (int)$_SESSION['loan_tn'];
        if($n == 0){
            unset($_SESSION['loan_stock']);
        }
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
                $ISBN =json_decode($_SESSION['loan_stock'],true);
                $size = count($ISBN);
                if($size>0){
                    $isbn = $ISBN[0]['ISBN'];
                    $_SESSION['r']=$ISBN[0]['ISBN'];
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
                }else{
                    $url = '#';
                }
            }
        }else{
            $_SESSION['loan_stock']= $_GET['stock'];
            if($n < $tn){
                $url = 'Location:../DBQuery/StockQuery.php?action='.$action.'&BID='.$records[$n]['BID'];
            }else{
                $ISBN =json_decode($_SESSION['loan_stock'],true);
                $size = count($ISBN);
                if($size>0){
                    $isbn = $ISBN[0]['ISBN'];
                    $_SESSION['r']=$ISBN[0]['ISBN'];
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
                }else{
                    $url = '#';
                }
            }
        }
    }else if($action == 'loan'){
        $n = (int)$_SESSION['loan_n'];
        $tn = (int)$_SESSION['loan_tn'];
        if($n == 0){
            unset($_SESSION['loan_stock']);
        }
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
                $ISBN =json_decode($str,true);
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
    }else if($action == 'loan_all'){
        $n = (int)$_SESSION['loan_n'];
        $tn = (int)$_SESSION['loan_tn'];
        if($n == 0){
            unset($_SESSION['loan_stock']);
        }
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
                $ISBN =json_decode($_SESSION['loan_stock'],true);
                $size = count($ISBN);
                if($size>0){
                    loan_stock();
                    $item = json_decode($_SESSION['library_all'],true);
                    $lib_name = $item[0]['LID'].'_stock';
                    $item_name = json_decode($_SESSION[$lib_name],true);
                    $_SESSION['item']=0;
                    $_SESSION['item_n']=0;
                    $current_n = count(json_decode($_SESSION[$lib_name]));
                    do{
                        if($current_n == 0){
                            unset($_SESSION[$item[$current_]['LID'].'_books']);
                        }
                        $_SESSION['item']=$current_n+1;
                        $lib_name = $item[$current_n+1]['LID'].'_stock';
                        $item_name = json_decode($_SESSION[$lib_name],true);
                        $current_n = count(json_decode($_SESSION[$lib_name]));
                    }while($current_n == 0);
                    $url = '#';
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$item_name[0]['ISBN'];
                }else{
                    $url = '#';
                }
            } 
        }else{
            $_SESSION['loan_stock']= $_GET['stock'];
            if($n < $tn){
                $url = 'Location:../DBQuery/StockQuery.php?action='.$action.'&BID='.$records[$n]['BID'];
            }else{
                $ISBN =json_decode($_SESSION['loan_stock'],true);
                $size = count($ISBN);
                if($size>0){
                    loan_stock();
                    $item = json_decode($_SESSION['library_all'],true);
                    $lib_name = $item[0]['LID'].'_stock';
                    $item_name = json_decode($_SESSION[$lib_name],true);
                    $_SESSION['item']=0;
                    $_SESSION['item_n']=0;
                    //$url = '#';
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$item_name[0]['ISBN'];
                }else{
                    $url = '#';
                }
            }
        }
    }else if($action == 'stock'){
        $_SESSION['LibStock'] = $_GET['stock'];
        unset($_SESSION['st_books'] );
        $stock = json_decode($_SESSION['LibStock'],true);
        $isbn = $stock[0]['ISBN'];
        $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
    }else if($action == 'AllStock'){
        $allStock = json_decode($_GET['stock'],true);
        DividedArea($allStock);
        $item = json_decode($_SESSION['library_all'],true);
        $lib_name = $item[0]['LID'].'_stock';
        $item_name = json_decode($_SESSION[$lib_name],true);
        $_SESSION['item']=0;
        $_SESSION['item_n']=0;
        $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$item_name[0]['ISBN'];
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
            $str2 ='{"LoanID":'.'"'.$loan_rd[$x]['LoanID'].'"'.','.'"AccID":'.'"'.$loan_rd[$x]['AccID'].'"'.','.'"BorrowingType":'.'"'.$loan_rd[$x]['BorrowingType'].'",'.'"Status":"'.$loan_rd[$x]['Status'].'","'.'ExpiryDate":'.'"'.date("Y-m-d",$loan_rd[$x]['ExpiryDate']['seconds']).'"'.','.'"ExpiryDate":'.'"'.date("Y-m-d",$loan_rd[$x]['ExpiryDate']['seconds']).'"}';
            array_push($loan,$str2);
        }
    }
    $_SESSION['loan_stock'] = '['.implode(',',$loan).']';
    return $str;
}
function DividedArea($allStock){
    $lib_n = json_decode($_SESSION['library_all'],true);
    $lib_arr = [];
    $len = count($lib_n);
    for($i=0;$i<$len;$i++){
        $lib_arr[$i] = [];
    }
    for($k=0;$k<count($allStock);$k++){
        for($y=0;$y<$len;$y++){
            if($lib_n[$y]['LID'] == $allStock[$k]['LID']){
                $str = '{"BID":"'.$allStock[$k]['BID'].'","Gain_Way":"'.$allStock[$k]['Gain_Way'].'","ISBN":"'.$allStock[$k]['ISBN'].'","LID":"'.$allStock[$k]['LID'].'","Position":"'.$allStock[$k]['Position'].'","Status":"'.$allStock[$k]['Status'].'"}';
                array_push($lib_arr[$y],$str);
                $y = $len + 1;
            }
        }
    }
    for($h=0;$h<$len;$h++){
        $target = $lib_n[$h]['LID'].'_stock';
        $_SESSION[$target] = '['.implode(',',$lib_arr[$h]).']'; 
    }
}

function loan_stock(){
    $stock = json_decode($_SESSION['loan_stock'],true);
    $loan_rd = json_decode($_SESSION['records'],true);
    $len = count($loan_rd);
    $lib_n = json_decode($_SESSION['library_all'],true);
    $lib_arr = [];
    $len2 = count($lib_n);
    for($i=0;$i<$len2;$i++){
        $lib_arr[$i] = [];
    }
    for($x=0;$x<$len;$x++){
        for($y=0;$y<$len2;$y++){
            if($lib_n[$y]['LID'] == $stock[$x]['LID']){
                $str2 ='{"LoanID":'.'"'.$loan_rd[$x]['LoanID'].'"'.','.'"AccID":'.'"'.$loan_rd[$x]['AccID'].'"'.','.'"BorrowingType":'.'"'.$loan_rd[$x]['BorrowingType'].'",'.'"Status":"'.$loan_rd[$x]['Status'].'","'.'ExpiryDate":'.'"'.date("Y-m-d",$loan_rd[$x]['ExpiryDate']['seconds']).'"'.','.'"ExpiryDate":'.'"'.date("Y-m-d",$loan_rd[$x]['ExpiryDate']['seconds']).'"'.','.'"ISBN":'.$stock[$x]['ISBN'].'}';
                array_push($lib_arr[$y],$str2);
                $y = $len2+1;
            }
        }
    }
    for($i=0;$i<$len2;$i++){
        $lib_name = $lib_n[$i]['LID'].'_stock';
        $_SESSION[$lib_name] ='['.implode(',',$lib_arr[$i]).']'; 
    }
}
?>
