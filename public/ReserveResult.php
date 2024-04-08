<?php
session_start();
$book = '';
$library = '';
$rid = '';
$LID = '';
$place = '';
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $rid = $_GET['rid'];
    $LID = $_GET['lib'];
}
if(isset($_SESSION['book'])){
    $account = json_decode($_SESSION['Account'],true);
    $book = json_decode($_SESSION['book'],true);
    $library = json_decode($_SESSION['library'],true);
}
for($i=0;$i<count($library);$i++){
    if($LID == $library[$i]['LID']){
        $place = $library[$i]['Library'];
        $i = count($library)+1;
    }
}
$_SESSION['Reserve'] = "true";
?>
<!DOCTYPE html>
<html>

<head>
    <style>
    a {
        text-decoration: none;
        color: black;
    }

    table,
    tr,
    td {
        border: 1px solid black;
    }

    .symbol {
        width: 1%;
    }

    .columns {
        width: 150px;
    }
    </style>
</head>

<body>
    <div style="text-align:center;font-size:20px;"><b>Reserve Book</b></div>
    <div>
        successfully Reserve the book!<br />
        BookName: <?=$book[0]['BookName_EN'];?><br />
        Applicant: <?=$account[0]['AccID']?><br />
        RID: <?=$rid;?><br />
        Pick up Location:<?=$place;?><br />
        <button><a href="JavaScript:window.close()">Close</a></button>
    </div>
</body>

</html>