<?php
$records = '';
$books = '';
$rn = 0;
include('../includes/header.php');
$records = json_decode($_SESSION['records'],true);
$rn = count($records);

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
                    <h4>Library Loan Records</h4>
                </div>
            </div>
            <div id='body'>
                <div class="card-body">
                    <div>
                    </div>
                    <div>
                        <?php
                    $table = '<table>';
                    $table .= '<tr><td>LoanID</td><td>Book Name</td><td></td><td></td></tr>';
                    $table.='</table>';
                    echo $table;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($rn == 0){
    echo '<script language="javascript" type="text/javascript">document.getElementById("body").innerHTML = "Sorry, can not find related records!";console.log("empty");</script>';
}else{
    echo '<script>console.log("empty");</script>';
}
include('../../includes/footer.php');
?>