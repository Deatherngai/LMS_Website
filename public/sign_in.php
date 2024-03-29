<?php
/*
 * @Author: Deatherngai tom2000998@yahoo.com.hk
 * @Date: 2023-12-19 09:06:29
 * @LastEditors: Deatherngai tom2000998@yahoo.com.hk
 * @LastEditTime: 2024-01-20 20:08:46
 * @FilePath: \LMS_Web(Firestore)\public\sign_in.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
$action = '';
session_start();
if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['action2'])){
        $action = $_GET['action2'];
    }
}
echo $action;
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
    <title>PHP Firebase</title>
</head>

<body>
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
                            <a class="nav-link active" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../public/AS.php">Advanced Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./DBQuery/LibraryQuery.php?action=info">Contact US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../public/sign_in.php">Login</a>
                        </li>
                </div>
            </div>
        </nav>
    </div>
    <div class="py-4">
        <main class="form-signin w-100 m-auto">
            <form action="../DBQuery/AccountQuery.php" method="POST" name="sign_form">
                <input type="hidden" class="form-control" id="action" name="action" value="SignIn">
                <img class="mb-4" src="statice/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" name="account" id="floatingInput" placeholder="Account ID"
                        required>
                    <label for="floatingInput">Account ID</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword"
                        placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
            </form>
        </main>
    </div>
    <script>
    var action = "<?=$action;?>";
    if (action != "") {
        document.getElementById("action").value = action;
        console.log(document.sign_form.action.value);
    } else {
        document.getElementById("action").value = "SignIn";
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>