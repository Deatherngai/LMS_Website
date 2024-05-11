<?php
ob_clean();
$action = '';
$book = '';
$url='';
$books = '';
$record = '';
$BID = '';
$n = 0;
$tn =0;
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if($action == "ListStock"){
        $_SESSION['BookStock'] = urldecode($_GET['book']);
        $url = 'Location:../index2.php';
    }else if($action == "MQ"){
        $_SESSION['QList'] = urldecode($_GET['book']);
        $url = 'Location:../public/Search_R.php?action=MQ';
    }else if($action == 'record' || $action == 'history'){
        if(isset($_SESSION['books'])){
            $book =  urldecode($_GET['book']);
            $record = json_decode($_SESSION['loan_stock'],true);
            $books = str_replace('[','',$_SESSION['books']);
            $books = str_replace(']','',$books);
            $book = str_replace('[','',$book);
            $book = str_replace(']','',$book);
            $_SESSION['books'] = '['.$books.','.$book.']';
            $b = count(json_decode($_SESSION['books'],true));
            $n = count($record);
            if($b<$n){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$record[$b]['ISBN'];
            }else{
                $url = 'Location:../User/Member/Loan_'.$action.'.php';
            }
        }else{
            $_SESSION['books'] =  urldecode($_GET['book']);
            $record = json_decode($_SESSION['loan_stock'],true);
            $n = count($record);
            $b = count(json_decode($_SESSION['books'],true));
            if($b<$n){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$record[$b]['ISBN'];
            }else{
                $url = 'Location:../User/Member/Loan_'.$action.'.php';
            }
        }
    }else if($action == "stock"){
        if(isset($_SESSION['st_books'])){
            $book =  urldecode($_GET['book']);
            $stock = json_decode($_SESSION['LibStock'],true);
            $books = str_replace('[','',$_SESSION['st_books']);
            $books = str_replace(']','',$books);
            $book = str_replace('[','',$book);
            $book = str_replace(']','',$book);
            if($book!=''){
                $_SESSION['st_books'] = '['.$books.','.$book.']';
            }
            $b = count(json_decode($_SESSION['st_books'],true));
            $n = count($stock);
            if($b<$n){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$b]['ISBN'];
            }else{
                $url = 'Location:../User/Staff/StockInfo.php';
            }
        }else{
            $_SESSION['st_books'] =  urldecode($_GET['book']);
            $stock = json_decode($_SESSION['LibStock'],true);
            $n = count($stock);
            $b = count(json_decode($_SESSION['st_books'],true));
            if($b<$n){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$b]['ISBN'];
            }else{
                $url = 'Location:../User/Staff/StockInfo.php';
            }
        }
    }else if($action == "BQ"){
        $_SESSION['book'] = urldecode($_GET['book']);
        $url = 'Location:../DBQuery/StockQuery.php?action='.$action;
    }else if($action == "search"){
        $_SESSION['QList'] = urldecode($_GET['book']);
        $url = 'Location:../public/Search_R.php?action=search';
    }else if($action == 'loan'){
        $n = (int)$_SESSION['l_b_n']+1;
        $tn = $_SESSION['l_b_tn'];
        $_SESSION['l_b_n'] = $n;
        if(isset($_SESSION['loan_books'])){
            $book = str_replace('[','',urldecode($_GET['book']));
            $book = str_replace(']','',$book);
            $books = str_replace('[','',$_SESSION['loan_books']);
            $books = str_replace(']','',$books);
            $_SESSION['loan_books'] = '['.$books.','.$book.']';
            if($n<$tn){
                $stock = json_decode($_SESSION['loan_isbn'],true);
                $_SESSION['r'].=$stock[$n]['ISBN'].',';
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$n]['ISBN'];
            }else{
                $url = 'Location:../User/Staff/LoanRecords.php';
            }
        }else{
            $_SESSION['loan_books'] = urldecode($_GET['book']);
            if($n<$tn){
                $stock = json_decode($_SESSION['loan_isbn'],true);
                $_SESSION['r'].=$stock[$n]['ISBN'].',';
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$n]['ISBN'];
            }else{
                $url = 'Location:../User/Staff/LoanRecords.php';
            }
        }
    }else if($action == 'loan_all'){
        $book = urldecode($_GET['book']);
        $item = (int)$_SESSION['item'];
        $item_n = (int)$_SESSION['item_n'];
        $libs = json_decode($_SESSION['library_all'],true);
        $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
        $groud = $libs[$item]['LID'].'_books';
        if($item_n == 0){
            unset($_SESSION[$groud]);
        }
        if(isset($_SESSION[$groud])){
            $book = str_replace('[','',urldecode($_GET['book']));
            $book = str_replace(']','',$book);
            $books = str_replace('[','',$_SESSION[$groud]); 
            $books = str_replace(']','',$books);
            $_SESSION[$groud] = '['.$books.','.$book.']';
            $item_n += 1; 
            if($item_n<count($stock)){
                $_SESSION['item_n'] = $item_n;
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
            }else{
                $item += 1;
                if($item<count($libs)){
                    $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
                    $item_n = 0;
                    $_SESSION['item'] = $item;
                    $_SESSION['item_n'] = $item_n;
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
                }else{
                    $url = 'Location:../User/Admin/LoanRecords.php';
                }
            }
        }else{
            $_SESSION[$groud] = $book;
            $item_n += 1;
            if($item_n<count($stock)){
                $_SESSION['item_n'] = $item_n;
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
            }else{
                $item += 1;
                if($item<count($libs)){
                    $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
                    $item_n = 0;
                    $_SESSION['item'] = $item;
                    $_SESSION['item_n'] = $item_n;
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
                }else{
                    $url = 'Location:../User/Admin/LoanRecords.php';
                }
            }
        }
    }else if($action == 'AllStock'){
        $book = urldecode($_GET['book']);
        $item = (int)$_SESSION['item'];
        $item_n = (int)$_SESSION['item_n'];
        $libs = json_decode($_SESSION['library_all'],true);
        $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
        $groud = $libs[$item]['LID'].'_books';
        if($item_n == 0){
            unset($_SESSION[$groud]);
        }
        if(isset($_SESSION[$groud])){
            $book = str_replace('[','',urldecode($_GET['book']));
            $book = str_replace(']','',$book);
            $books = str_replace('[','',$_SESSION[$groud]);
            $books = str_replace(']','',$books);
            $_SESSION[$groud] = '['.$books.','.$book.']';
            $item_n += 1;
            if($item_n<count($stock)){
                $_SESSION['item_n'] = $item_n;
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
            }else{
                $item += 1;
                if($item<count($libs)){
                    $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
                    $item_n = 0;
                    $_SESSION['item'] = $item;
                    $_SESSION['item_n'] = $item_n;
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
                }else{
                    $url = 'Location:../User/Admin/LibStock.php';
                }
            }
        }else{
            $_SESSION[$groud] = $book;
            $item_n += 1;
            if($item_n<count($stock)){
                $_SESSION['item_n'] = $item_n;
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
            }else{
                $item += 1;
                if($item<count($libs)){
                    $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
                    $item_n = 0;
                    $_SESSION['item'] = $item;
                    $_SESSION['item_n'] = $item_n;
                    $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
                }else{
                    $url = 'Location:../User/Admin/LibStock.php';
                }
            }
        }
    }else if($action == 'r_record'){
        $rn = (int)$_SESSION['rn'];
        $records = json_decode($_SESSION['r_records'],true);
        if(isset($_SESSION['r_books'])){
            $book = str_replace('[','',urldecode($_GET['book']));
            $book = str_replace(']','',$book);
            $books = str_replace('[','',$_SESSION['r_books']);
            $books = str_replace(']','',$books);
            $_SESSION['r_books'] = '['.$books.','.$book.']';
            if(($rn)<count($records)){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$records[$rn]['ISBN'];
                $_SESSION['rn'] = $rn+1;
            }else{
                $url = 'Location:../public/ReserveRecords.php';
            }
        }else{
            $_SESSION['r_books'] = urldecode($_GET['book']);
            if(($rn)<count($records)){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$records[$rn]['ISBN'];
                $_SESSION['rn'] = $rn+1;
            }else{
                $url = 'Location:../public/ReserveRecords.php';
            }
        }
    }else if($action == 'r_records'){
        $rn = (int)$_SESSION['rrn'];
        $item_n = (int)$_SESSION['item_n'];
        $lib = json_decode($_SESSION['library_all'],true);
        $cur = $lib[$rn]['LID'].'_resever';
        $list = json_decode($_SESSION[$cur],true);
        $groud = $lib[$rn]['LID'].'_books';
        if($item_n == 1){
            unset($_SESSION[$groud]);
        }
        if(isset($_SESSION[$groud])){
            $book = str_replace('[','',urldecode($_GET['book']));
            $book = str_replace(']','',$book);
            $books = str_replace('[','',$_SESSION[$groud]);
            $books = str_replace(']','',$books);
            $_SESSION[$groud] = '['.$books.','.$book.']';
            if(($item_n)<count($list)){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$list[$item_n]['ISBN'];
                $_SESSION['item_n'] = $item_n+1;
            }else{
                $rn = $rn + 1;
                if($rn<count($lib)){
                    $cur = $lib[$rn]['LID'].'_resever';
                    $isbn = "";
                    if(isset($_SESSION[$cur])){
                        $list = json_decode($_SESSION[$cur],true);
                        $n = count($list);
                        if($n!=0){
                            $isbn = $list[0]['ISBN'];
                            $_SESSION['rrn'] = $rn;
                            $_SESSION['item_n'] = 1;
                            $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
                        }
                    }
                }else{
                    $url = 'Location:../User/ReserveRecords.php';
                    echo "end2";
                }
            }
        }else{
            $_SESSION[$groud] = urldecode($_GET['book']);
            if(($item_n)<count($list)){
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$list[$item_n]['ISBN'];
                $_SESSION['item_n'] = $item_n+1;
            }else{
                $rn = $rn + 1;
                if($rn<count($lib)){
                    $cur = $lib[$rn]['LID'].'_resever';
                    $isbn = "";
                    if(isset($_SESSION[$cur])){
                        $list = json_decode($_SESSION[$cur],true);
                        $n = count($list);
                        if($n!=0){
                            $isbn = $list[0]['ISBN'];
                            $_SESSION['rrn'] = $rn;
                            $_SESSION['item_n'] = 1;
                            $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$isbn;
                        }
                    }
                }else{
                    $url = 'Location:../User/ReserveRecords.php';
                    echo "end";
                }
            }
        }
    }
    header($url);
    exit;
}
?>
