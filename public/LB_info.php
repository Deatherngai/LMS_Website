<?php
include('includes/header.php');
$info = "";
$n = "";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $info =  $_GET['query'];
}
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

tr:nth-child(odd) {
    background: #f0f0f0;
}

tr:nth-child(even) {
    background: #FFF;
}
</style>
<h1 id="t"></h1>
<p id=" info" style="display:none;"><?= $Info; ?></p>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Library Information</h4>
                </div>
            </div>
            <div id="LB_info" class="card-body">
                <?php
                $info = json_decode($info,true);
                $len = count($info);
                $content = "";
                for($x=0;$x<$len;$x++){
                    $content.='<table>';
                    $content.='<tr><td>Library</td><td>'.$info[$x]['Library'].'</td><td rowspan=3><img style="height:120px; width:180px;" src="'.$info[$x]['img'].'"
                                    alt="'.$info[$x]['Library'].'" /></td></tr>';
                    $content.='<tr><td>Contact</td><td>'.$info[$x]['Contact'].'</td></tr>';
                    $content.='<tr><td>Location</td><td>'.$info[$x]['Location'].'</td></tr>';
                    $content.='</table>';
                    $content.='<br />';
                }
                echo $content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('../includes/footer.php')
?>