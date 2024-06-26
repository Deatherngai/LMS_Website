<?php
$action = '';
$login = '';
session_start();
if(isset($_SESSION['login2'])){
    $login = $_SESSION['login2'];
}
if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['action2'])){
        $action = $_GET['action2'];
    }
}
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
    <link href="../static/css/sign.css" rel="stylesheet">
    <!--<link href="../static/css/bootstrap.min.css" rel="stylesheet" />-->
    <script src="../static/jslib/jquery-1.11.1.js"></script>
    <title>Sign In</title>
</head>

<body>
<style>
    .icon{
        width:30px;
        height:30px;
    }
    .nav-item{
        margin-left:20px;
    }
</style>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" id="btn" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                    <a class="nav-link active" href="../index.php"><img class="icon" src="..\static\icons\home.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../public/AS.php"><img class="icon" src="..\static\icons\Book_Search.png" /></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link active" href="#"><img class="icon" src="..\static\icons\report.png" /></a>
                        <div class="dropdown-content">
                            <a href="../DBQuery/ReportQuery.php?action=report">Book Report List</a>
                            <a href="https://colab.research.google.com/drive/18Q94KrAXt6zc9-PRkhUYjBPaeo1yRu1k?usp=sharing" target="_blank">Write Book Report</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../DBQuery/LibraryQuery.php?action=info"><img class="icon" src="..\static\icons\Contact_us.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../public/sign_in.php"><img class="icon" src="..\static\icons\login.png" /></a>
                </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="py-4">
        <main class="form-signin w-100 m-auto">
            <form action="../DBQuery/AccountQuery.php" method="POST" name="sign_form">
                <input type="hidden" class="form-control" id="action" name="action" value="SignIn">
                <img class="mb-4" src="..\static\icons\login.png" alt="" width="100" height="100">
                <div id="msg"><b style="color:red;">Sorry, your account ID or password is incorrect, Please try again</b></div>
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" name="account" id="floatingInput" placeholder="Account ID"
                        required>
                    <label for="floatingInput">Account ID</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="Password"
                        placeholder="Password" required>
                    <label for="floatingPassword">Password</label><br />
                    <input type="checkbox" onclick="showPW()">Show Password
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            </form>
        </main>
    </div>
    <script>
    var action = "<?=$action;?>";
    var msg = "<?=$login;?>";
    if(msg === 'false'){
        document.getElementById("msg").style.display = "";
    }else{
        document.getElementById("msg").style.display = "none";
        console.log("error");
    }
    if (action != "") {
        document.getElementById("action").value = action;
    } else {
        document.getElementById("action").value = "SignIn";
    }
    function showPW() {
        var x = document.getElementById("Password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>
</html>
