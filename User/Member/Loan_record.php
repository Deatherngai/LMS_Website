<?php
$records = '';
$books = '';
include('../includes/header.php');
?>
<style>
table,
tr,
td,
th {
    border: 1px solid black;
}

tr:nth-child(odd) {
    background: #f0f0f0;
}

tr:nth-child(even) {
    background: #FFF;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Loan Records</h4>
                </div>
            </div>
            <div class="card-body">
                <div style="margin-top:50px;">
                    <?php
                $content = '';
                $records = json_decode($_SESSION['records'],true);
                $books = json_decode($_SESSION['books'],true);
                $len = count($records);
                if($len>0){
                    $content .= '<table border="1">';
                    $content .= '<tr><th>Expiry Date</th><th>Export Date</th><th>Renewals</th><th>Book Name</th><th>Author</th><th>Publication</th><th>Status</th></tr>';
                    for($x=0;$x<$len;$x++){
                        $content .= '<tr><td>'.date("Y-m-d",$records[$x]['ExpiryDate']['seconds']).'</td><td>'.date("Y-m-d",$records[$x]['ExportDate']['seconds']).'</td><td>'.$records[$x]['renewals'].'</td><td>'.$books[$x]['BookName_EN'].'</td><td>'.$books[$x]['Author'].'</td><td>'.$books[$x]['Publication'].'</td><td>'.$records[$x]['Status'].'</td></tr>';
                    }
                    $content .='</table>';
                }else{
                    $content.="At present, no loan records!";
                }
                echo $content;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../../includes/footer.php');
?>