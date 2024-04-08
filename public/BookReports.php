<?php
include('includes/header.php');
$info = "";
$n = "";
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
                    <h4>Book Reports</h4>
                </div>
            </div>
            <div id="LB_info" class="card-body">
                
            </div>
        </div>
    </div>
</div>
<?php
include('../includes/footer.php');
?>