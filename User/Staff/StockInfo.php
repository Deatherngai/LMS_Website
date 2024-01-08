<?php
$records = '';
$books = '';
include('../includes/header.php');
$stock = json_decode($_SESSION['LibStock'],true);
$stockList = json_decode($_SESSION['st_books'],true);
$len = count($stockList);
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
                    <h4>Library Stocks</h4>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label>Filter Criteria:</label><br />
                    <label>Subject:</label>
                    <select>
                        <?php
                        $str2 = '<option value='.$stockList[0]['Subject'].'>'.$stockList[0]['Subject'].'</option>';
                        for($x=1;$x<$len;$x++){
                            if(!str_contains($str2,$stockList[$x]['Subject'])){
                                $str2 .= '<option value='.$stockList[$x]['Subject'].'>'.$stockList[$x]['Subject'].'</option>';
                            }
                        }
                        echo $str2;
                        ?>
                    </select>
                </div>
                <div id='adult'>
                    <?php
                    $table = '<table><tr><td colspan="5">Sub1</td></tr>';
                    for($x=0;$x<$len;$x++){
                            $table .= '<tr><td>'.$stockList[$x]['BookName_EN'].'</td>';
                            $table .='<td>'.$stockList[$x]['Author'].'</td>';
                            $table .='<td>'.$stockList[$x]['ISBN'].'</td>';
                            $table .='<td>'.$stock[$x]['LID'].'</td>';
                            $table .='<td>'.$stock[$x]['Status'].'</td></tr>';
                    }
                    $table.='</table>';
                    echo $table;
                    ?>
                </div>
                <div id='child'>
                    <table>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../../includes/footer.php');
?>