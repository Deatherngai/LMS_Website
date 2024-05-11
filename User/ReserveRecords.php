<?php
session_start();
$libs = json_decode($_SESSION['library_all'],true);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="../static/css/navbar_m.css" rel="stylesheet">
    <link href="../static/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../static/css/layout.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Library Management System</title>
</head>

<body>
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
<div>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == "true") {
            switch($_SESSION['AccType']){
                case 'staff':
                    include('navbar_s.php');
                    break;
                case 'leader':
                    include('navbar_s.php');
                    break;
                case 'admin':
                    include('navbar_a.php');
                    break;
                default:
                    include('navbar.php');
                    break;
            }
        } else {
            include('navbar.php');
        }
        ?>
    </div>
<div>
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
                for($i=0;$i<count($libs);$i++){
                        $stock = json_decode($_SESSION[$libs[$i]['LID'].'_resever'],true);
                        $books = $libs[$i]['LID'].'_books';
                        $books = json_decode($_SESSION[$books],true);
                        $table = '<table><tr><td colspan="7">'.$libs[$i]['Library'].'</td></tr>';
                        $table .= '<tr><td>Reserver ID</td><td>Book Name</td><td>Author</td></td><td>Maker of appointment</td><td>ApplyDate</td>';
                        $table .='<td>FixedDate</td><td>Status</td></tr>';
                        for($x=0;$x<count($books);$x++){
                                $table .= '<tr><td>'.$stock[$x]['RD'].'</td>';
                                $table .= '<td>'.$books[$x]['BookName_EN'].'</td>';
                                $table .='<td>'.$books[$x]['Author'].'</td>';
                                $table .='<td>'.$stock[$x]['AccID'].'</td>';
                                $table .='<td>'.date("Y-m-d",$stock[$x]['ApplyDate']['seconds']).'</td>';
                                if($stock[$x]['Status'] != 'Processed'){
                                    $table .='<td></td>';
                                    $table .='<td>'.$stock[$x]['Status'].'</td>';
                                }else{
                                    $table .='<td>'.date("Y-m-d",$stock[$x]['FixedDate']['seconds']).'</td>';
                                    $table .='<td>'.$stock[$x]['Status'].'</td>';
                                }
                        }
                        $table.='</table>';
                        echo $table;
						echo "<br />";
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
<?php
include('../includes/footer.php');
?>
