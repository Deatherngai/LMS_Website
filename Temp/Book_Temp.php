<?php
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
        $_SESSION['BookStock'] = urldecode($_GET['books']);
        $url = 'Location:../index2.php';
    }else if($action == "MQ"){
        $_SESSION['QList'] = urldecode($_GET['books']);
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
                echo $_SESSION['loan_stock'];
                $url = '#';
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
            $book =  urldecode($_GET['books']);
            $stock = json_decode($_SESSION['LibStock'],true);
            $books = str_replace('[','',$_SESSION['st_books']);
            $books = str_replace(']','',$books);
            $book = str_replace('[','',$book);
            $book = str_replace(']','',$book);
            if($book!=''){
                $_SESSION['st_books'] = '['.$books.','.$book.']';
            }
            $b = count(json_decode($_SESSION['st_books'],true));
            echo $_SESSION['st_books'];
            $n = count($stock);
            echo $b;
            if($b<$n){
                echo 'countinue';
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$b]['ISBN'];
            }else{
                echo 'end';
                $url = 'Location:../User/Staff/StockInfo.php';
            }
        }else{
            echo 'first';
            $_SESSION['st_books'] =  urldecode($_GET['books']);
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
        echo $action;
        $_SESSION['book'] = urldecode($_GET['book']);
        echo urldecode($_GET['book']);
        //$url = '';
        $url = 'Location:../DBQuery/StockQuery.php?action='.$action;
    }else if($action == "search"){
        $_SESSION['QList'] = urldecode($_GET['books']);
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
                echo $_SESSION['loan_books'];
                echo $_SESSION['r'];
                $url = 'Location:../User/Staff/LoanRecords.php';
            }
        }else{
            $_SESSION['loan_books'] = urldecode($_GET['book']);
            if($n<$tn){
                $stock = json_decode($_SESSION['loan_isbn'],true);
                $_SESSION['r'].=$stock[$n]['ISBN'].',';
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$n]['ISBN'];
            }else{
                echo $_SESSION['loan_books'].'<br/>';
                echo $_SESSION['r'].',';
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
                    echo $groud."<br />";
                    echo $_SESSION[$groud];
                    $url = 'Location:../User/Admin/LoanRecords.php';
                }
            }
        }else{
            $_SESSION[$groud] = $book;
            echo $item_n;
            echo $book;
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
                    echo $groud."<br />";
                    echo $_SESSION[$groud];
                    $url = 'Location:../User/Admin/LoanRecords.php';
                }
            }
        }
    }else if($action == 'AllStock'){
        $book = urldecode($_GET['books']);
        $item = (int)$_SESSION['item'];
        $item_n = (int)$_SESSION['item_n'];
        $libs = json_decode($_SESSION['library_all'],true);
        $stock = json_decode($_SESSION[$libs[$item]['LID'].'_stock'],true);
        $groud = $libs[$item]['LID'].'_books';
        if($item_n == 0){
            unset($_SESSION[$groud]);
        }
        if(isset($_SESSION[$groud])){
            $book = str_replace('[','',urldecode($_GET['books']));
            $book = str_replace(']','',$book);
            $books = str_replace('[','',$_SESSION[$groud]);
            $books = str_replace(']','',$books);
            $_SESSION[$groud] = '['.$books.','.$book.']';
            $item_n += 1;
            if($item_n<count($stock)){
                $_SESSION['item_n'] = $item_n;
                $url = 'Location:../DBQuery/BookQuery.php?action='.$action.'&isbn='.$stock[$item_n]['ISBN'];
                echo  $item_n;
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
                echo  $item_n;
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
    }
    header($url);
}
?>
<link href="../static/css/animation.css" rel="stylesheet">
<body translate="no" >
  <div class="loader"></div>
</body>
