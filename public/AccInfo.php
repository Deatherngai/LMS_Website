<?php
include('includes/header.php');
$info = "";
$n = "";
$acc = json_decode($_SESSION['Account'] ,true);
?>
<style>
table,
th,
td {
    border: 1px solid black;
    border-collapse: collapse;
}

td {
    padding: 10px;
}
</style>
<h1 id="t"></h1>
<p id=" info" style="display:none;"><?= $Info; ?></p>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Personal Details</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="frame">
                    <?php
                    $content='';
                    $content.='<table id="Acc_Info">';
                    $content.='<tr><td>Account ID</td><td>'.$acc[0]['AccID'].'</td></tr>';
                    $content.='<tr><td>Name</td><td></td></tr>';
                    $content.='<tr><td>Conact Number</td><td></td></tr>';
                    $content.='<tr><td>Contact Address</td><td></td></tr>';
                    $content.='<tr><td>Account Status</td><td>'.$acc[0]['Status'].'</td></tr>';
                    $content.='</table>';
                    $content.='<br />';
                echo $content;
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php
include('../includes/footer.php')
?>