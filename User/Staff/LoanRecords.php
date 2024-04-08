<?php
/*
 * @Author: Deatherngai tom2000998@yahoo.com.hk
 * @Date: 2023-12-19 12:34:13
 * @LastEditors: Deatherngai tom2000998@yahoo.com.hk
 * @LastEditTime: 2024-01-21 13:56:48
 * @FilePath: \LMS_Web(Firestore)\User\Staff\LoanRecords.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
$books = '';
$rn = 0;
include('../includes/header.php');
$records = json_decode($_SESSION['loan_stock'],true);
$booksInfo =json_decode($_SESSION['loan_books'],true);
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
                        $table = '<table style="margin-top:30dp;">';
                        $table .= '<tr><td>LoanID</td><td>Book Name</td><td>Author</td><td>Browing Account</td><td>Status</td><td>Due Date</td></tr>';
                        for($x=0;$x<$rn;$x++){
                        $table.= '<tr><td>'.$records[$x]['LoanID'].'</td><td>'.$booksInfo[$x]['BookName_EN'].'</td><td>'.$booksInfo[$x]['Author'].'</td><td>'.$records[$x]['AccID'].'</td><td>'.$records[$x]['Status'].'</td><td>'.$records[$x]['ExpiryDate'].'</td></tr>';
                    }
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