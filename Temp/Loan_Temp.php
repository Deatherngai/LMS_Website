<<<<<<< HEAD

=======
>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
<?php
session_start();
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
}
?>
<<<<<<< HEAD
<link href="../static/css/animation.css" rel="stylesheet" />
<body translate="no" >
  <div class="loader"></div>
</body>
=======
>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
