<?php
$stock = '';
$books = '';
$libs = '';
include('../includes/header.php');
$libs = json_decode($_SESSION['library_all'],true);
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
<script>
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Library Loan stock</h4>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label>Filter Criteria:</label><br />
                    <label>Library:</label>
                    <select id="library" onchange="Criteria()">
                    <?php
                        $option = '<option value="null">Please select a library</option>'; 
                        for($i=0;$i<count($libs);$i++){
                            $option .='<option value="'.$libs[$i]['LID'].'">'.$libs[$i]['Library'].'</option>';
                        }
                        echo $option;
                    ?>
                    </select><br/>
                </div>
                <div id='adult'>
                    <?php 
                    for($i=0;$i<count($libs);$i++){
                        $books = $libs[$i]['LID'].'_books';
                        $stock = $libs[$i]['LID'].'_stock';
                        if(isset($_SESSION[$books])){
                            echo '<script>console.log('.$_SESSION[$books].');</script>';
                            $books = json_decode($_SESSION[$books],true);
                            $stock = json_decode($_SESSION[$stock],true);
                            if(count($stock)>0){
                                $table = '<table style="margin-top:30dp;" id="'.$libs[$i]['LID'].'">';
                                $table .= '<tr><th colspan="6">'.$libs[$i]['Library'].'</th></tr>';
                                $table .= '<tr><td>LoanID</td><td>Book Name</td><td>Author</td><td>Browing Account</td><td>Status</td><td>Due Date</td></tr>';
                                $rn =count($stock);
                                for($x=0;$x<$rn;$x++){
                                    $table.= '<tr><td>'.$stock[$x]['LoanID'].'</td><td>'.$books[$x]['BookName_EN'].'</td><td>'.$books[$x]['Author'].'</td><td>'.$stock[$x]['AccID'].'</td><td>'.$stock[$x]['Status'].'</td><td>'.$stock[$x]['ExpiryDate'].'</td></tr>';
                                }
                                $table.='</table><br />';
                                echo $table;
                            }else{
                                $table = '<table style="margin-top:30dp;" id="'.$libs[$i]['LID'].'">';
                                $table .= '<tr><th colspan="6">'.$libs[$i]['Library'].'</th></tr>';
                                $table .= '<tr><td colspan="6">Can not find related records!</td></tr>';
                                $table.='</table><br />';
                                echo $table;
                            }
                        }else{
                            $_SESSION[$books] = '[]';
                            $_SESSION[$stock] = '[]';
                            $table = '<table style="margin-top:30dp;" id="'.$libs[$i]['LID'].'">';
                            $table .= '<tr><th colspan="6">'.$libs[$i]['Library'].'</th></tr>';
                            $table .= '<tr><td colspan="6">Can not find related records!</td></tr>';
                            $table.='</table><br />';
                            echo $table;
                        }
                    }
                    ?>
                </div>
                <div id="content"></div>
            </div>
        </div>
    </div>
</div>
<script>
function Criteria(){
    var library = document.getElementById("library").value;
    let arr = [];
    if(!(library === "null")){
        ShowTable(library);
    }else{
        showAll();
    }
}
function ShowTable(library){
    let lib = <?=$_SESSION['library_all'];?>;
    document.getElementById("adult").style.display ="";
    document.getElementById("content").style.display ="none";
    for(let i=0;i<lib.length;i++){
        if(lib[i].LID === library){
            document.getElementById(lib[i].LID).style.display ="";
        }else{
            document.getElementById(lib[i].LID).style.display ="none";
        }
    }
}
function showAll(){
    let lib = <?=$_SESSION['library_all'];?>;
    document.getElementById("adult").style.display ="";
    document.getElementById("content").style.display ="none";
    for(let i=0;i<lib.length;i++){
        document.getElementById(lib[i].LID).style.display ="";
    }
}
</script>
<?php
include('../../includes/footer.php');
?>