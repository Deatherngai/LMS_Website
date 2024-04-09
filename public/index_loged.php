<?php
$acc="";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!empty($_GET['sign']) && !empty($_GET['data'])) {
        $_SESSION['login'] = $_GET['sign'];
        $acc = $_GET['data'];
    } else {
        if (!isset($_SESSION['login'])) {
            $_SESSION['login'] = false;
        }
    }
}
$acc = json_decode($acc,true);
$_SESSION['AccId'] = $acc[0]['AccID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="../static/css/navbar_m.css" rel="stylesheet">
    <link href="../static/css/sign.css" rel="stylesheet">
    <!--<link href="../static/css/bootstrap.min.css" rel="stylesheet" />-->
    <script src="../static/jslib/jquery-1.11.1.js"></script>
    <title>PHP Firebase</title>
</head>

<body>
    <div>
        <?php
            include('includes/navbar_m.php');
        ?>
    </div>
    <div class="py-4">
        <script>
        $(document).ready(function() {
            $(document).prop('title', 'Home');
            var login = "<?= $_SESSION['login']; ?>";
            const stock = eval($("#bookStock").text());
            var content = "";
            for (let i = 0; i < stock.length; i++) {
                var a_tag = "<a href='../DBQuery/BookQuery.php?action=BQ&isbn=" + stock[i].ISBN + "'>" + stock[
                        i].BookName_EN +
                    "</a>";
                content += "<tr><td>" + i + 1 + "</td>";
                content += "<td>" + a_tag + "</td>";
                content += "<td>" + stock[i].Author + "</td>";
                content += "<td>" + stock[i].Publication + "</td>";
                content += "<td>" + stock[i].Publication_Year + "</td>";
                content += "</tr>";
            }
            $("#img").html(stock[0].img);
            $("#list").html(content);
        });
        </script>
        <div class="py-4">
            <p id="bookStock" style="display:none;"><?=$_SESSION['BookStock'];?></p>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <?php
                if(isset($_SESSION['status'])){
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }
                ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <form action="./Search_R.php" method="POST">
                                        <input type="text" name="action" class="form-control" value="search"
                                            style="display:none;" />
                                        <div id="search">
                                            <input type="text" name="condit" class="form-control" />
                                        </div>
                                        <div class="search_btn">
                                            <button type="submit" name="search" id="btn_s">Searching</button>
                                        </div>
                                    </form>
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S1.no</th>
                                        <th>Book Name</th>
                                        <th>Author</th>
                                        <th>Publication</th>
                                        <th>Publication Year</th>
                                    </tr>
                                </thead>
                                <tbody id="list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>