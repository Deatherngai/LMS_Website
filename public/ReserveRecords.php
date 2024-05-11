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
                    <h4>Reserve Records</h4>
                </div>
            </div>
            <div id="LB_info" class="card-body">
                <?php
                    $account = json_decode($_SESSION['Account'],true);
                    $content = '';
                    //echo $_SESSION['KLL_books'];
                    if($account[0]['AccType'] == "member"){
                        if(isset($_SESSION['r_books'])){
                            $r_books = json_decode($_SESSION['r_books'],true);
                            $records = json_decode($_SESSION['r_records'],true);
                            $library = json_decode($_SESSION['library_all'],true);
                            $content = '<table>';
                            $content .= '<tr><td>Reserve ID</td><td>Book Name</td><td>Get Location</td><td>Apply Date</td><td>Status</td><td>Fixed Date</td></tr>';
                            for($i=0;$i<count($r_books);$i++){
                                for($k=0;$k<count($library);$k++){
                                    if($records[$i]['LID'] == $library[$k]['LID']){
                                        if(date("Y-m-d",$records[$i]['ApplyDate']['seconds']) == date("Y-m-d",$records[$i]['FixedDate']['seconds'])){
                                            $content .= '<tr><td>'.$records[$i]['RD'].'</td><td>'.$r_books[$i]['BookName_EN'].'</td><td>'.$library[$k]['Library'].'</td><td>'.date("Y-m-d",$records[$i]['ApplyDate']['seconds']).'</td><td>'.$records[$i]['Status'].'</td><td></td></tr>';
                                        }else{
                                            $content .= '<tr><td>'.$records[$i]['RD'].'</td><td>'.$r_books[$i]['BookName_EN'].'</td><td>'.$library[$k]['Library'].'</td><td>'.date("Y-m-d",$records[$i]['ApplyDate']['seconds']).'</td><td>'.$records[$i]['Status'].'</td><td>'.date("Y-m-d",$records[$i]['FixedDate']['seconds']).'</td></tr>';
                                        }
                                        $k = count($library)+1;
                                    }
                                }
                            }
                            $content .= '</table>';
                        }else{
                            $content = 'Currently no any resever records!';
                        }
                    }else{
                        $library = json_decode($_SESSION['library_all'],true);
                        for($k=0;$k<count($library);$k++){
                            $target = $library[$k]['LID'].'_resever';
                            $records = json_decode($_SESSION[$target],true);
                            $n = count($records);
                            if($n>0){
                                $content .= '<table>';
                                $content .= '<tr><th colspan="6">'.$library[$k]['Library'].'</th></tr>';
                                $content .= '<tr><td>Reserve ID</td><td>Book Name</td><td>Get Location</td><td>Apply Date</td><td>Status</td><td>Fixed Date</td></tr>';
                                $item = $library[$k]['LID'].'_books';
                                $books =json_decode($_SESSION[$item],true);
                                for($e=0;$e<$n;$e++){
                                    if($records[$e]['Status'] == "Wait"){
                                        $content .= '<tr><td>'.$records[$e]['RD'].'</td><td>'.$books[$e]['BookName_EN'].'</td><td>'.$library[$k]['Library'].'</td><td>'.date("Y-m-d",$records[$e]['ApplyDate']['seconds']).'</td><td>'.$records[$e]['Status'].'</td><td></td></tr>';
                                    }else{
                                        $content .= '<tr><td>'.$records[$e]['RD'].'</td><td>'.$books[$e]['BookName_EN'].'</td><td>'.$library[$k]['Library'].'</td><td>'.date("Y-m-d",$records[$e]['ApplyDate']['seconds']).'</td><td>'.$records[$e]['Status'].'</td><td>'.date("Y-m-d",$records[$e]['FixedDate']['seconds']).'</td></tr>';
                                    }
                                }
                                $content .= '</table><br />';
                            }else{
                                $content .= '<table>';
                                $content .= '<tr><th colspan="6">'.$library[$k]['Library'].'</th></tr>';
                                $content .= '<tr><td colspan="6">Currently no any reserved records</td></tr>';
                                $content .= '</table><br />';
                            }
                        }
                    }
                    echo $content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('../includes/footer.php');
?>
