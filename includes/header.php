<?php
session_start();
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
    <link href="./static/css/navbar_m.css" rel="stylesheet">
    <link href="./static/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./static/css/layout.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Library Management System</title>
</head>

<body>
    <div>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == "true") {
            switch($_SESSION['AccType']){
                case 'member':
                    include('navbar_m.php');
                    break;
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
    <div class="py-4">
