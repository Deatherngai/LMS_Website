<<<<<<< HEAD
<?php
include('includes/header.php');
$n=0;
$stock="";
$book ="";
$rn = 0;
$library="";
if(isset($_SESSION['book'])){
    $book = json_decode($_SESSION['book'],true);
}
if(isset($_SESSION['stock'])){
    $stock = json_decode($_SESSION['stock'],true);
}
if(isset($_SESSION['library'])){
    $library = json_decode($_SESSION['library'],true);
}
//echo count($book);
//echo count($stock);
//echo count($library);
?>
<script>
function Reserve() {
    var login = "<?=$_SESSION['login'];?>";
    let url;
    let height = screen.width - 10;
    let width = screen.height - 10;
    var left = (screen.width) / 4;
    var top = (screen.height) / 2;
    let myWindow;
    if (login == "true") {
        url = "./Reserve.php";
        myWindow = window.open(url, "center window", 'resizable = yes, width=' + width + ', height=' + height +
            ', top=' + top + ', left=' + left);
    } else {
        url = "./sign_in.php?action2=reserve";
        myWindow = window.open(url, "center window", 'resizable = yes, width=' + width + ', height=' + height +
            ', top=' + top + ', left=' + left);
    }
    var newwindow = false;
    myWindow.onunload = function() {
        if (myWindow.closed) {
            //alert("Window Closed by Your function");
        } else if (myWindow && newwindow) {
            //alert("Window Closed by close button");
        } else {
            newwindow = true;
        }
    };
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['status'])) {
                echo "<h5 class='alert alert-success'>" . $_SESSION['status'] . "</h5>";
                unset($_SESSION['status']);
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        <form action="../DBQuery/BookQuery.php" method="POST">
                            <input type="text" name="action" class="form-control" value="search"
                                style="display:none;" />
                            <input type="text" name="condit" class="form-control" />
                            <button type="submit" name="search">Searching</button>
                        </form>
                    </h4>
                </div>
            </div>
            <hr />
            <div class="card-body">
                <div>
                    <h5><?=$book[0]['BookName_EN'];?></h5>
                    <table style="border:1px solid black;">
                        <tr>
                            <td colspan="2" rowspan="9"><img src="<?=$book[0]['img'];?>"
                                    alt="<?=$book[0]['BookName_EN'];?>" /></td>
                        </tr>
                        <tr>
                            <td>Call No.</td>
                            <td><?= $book[0]['Call_No']; ?></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                            <td><?= $book[0]['Author']; ?></td>
                        </tr>
                        <tr>
                            <td>Edition</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Publication</td>
                            <td><?= $book[0]['Publication']; ?></td>
                        </tr>
                        <tr>
                            <td>Year of Publication</td>
                            <td><?= $book[0]['Publication_Year']; ?></td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td><?= $book[0]['Subject']; ?></td>
                        </tr>
                        <tr>
                            <td>ISBN</td>
                            <td><?= $book[0]['ISBN']; ?></td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td><?= $book[0]['Language']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="5"><?=$rn;?> reservation made for this item<button onclick="Reserve()"
                                    value="reserve" style="position: relative;left:20px;"><img style="width:35px;height:35px;" src="..\static\icons\reserved.png" /></button></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
                <?php
                $len = count($stock);
                    $content = '';
                    $content .= '<table class="table table-bordered table-striped">';
                    $content .= '<tr><th>Library</th><th>Call No.</th><th>Status</th><th>Position</th></tr>';
                    for ($x=0;$x<$len;$x++){
                        $content .= '<tr><th>'.$library[$x]['Library'].'</th><th>Call No.</th><th>'.$stock[$x]['Status'].'</th><th>'.$stock[$x]['Position'].'</th></tr>';;
                    }
                    $content .= '<table>';
                echo $content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
=======
<?php
include('includes/header.php');
$n=0;
$stock="";
$book ="";
$rn = 0;
$library="";
if(isset($_SESSION['book'])){
    $book = json_decode($_SESSION['book'],true);
}
if(isset($_SESSION['stock'])){
    $stock = json_decode($_SESSION['stock'],true);
}
if(isset($_SESSION['library'])){
    $library = json_decode($_SESSION['library'],true);
}
//echo count($book);
//echo count($stock);
//echo count($library);
?>
<script>
function Reserve() {
    var login = "<?=$_SESSION['login'];?>";
    let url;
    let height = screen.width - 10;
    let width = screen.height - 10;
    var left = (screen.width) / 4;
    var top = (screen.height) / 2;
    let myWindow;
    if (login == "true") {
        url = "./Reserve.php";
        myWindow = window.open(url, "center window", 'resizable = yes, width=' + width + ', height=' + height +
            ', top=' + top + ', left=' + left);
    } else {
        url = "./sign_in.php?action2=reserve";
        myWindow = window.open(url, "center window", 'resizable = yes, width=' + width + ', height=' + height +
            ', top=' + top + ', left=' + left);
    }
    var newwindow = false;
    myWindow.onunload = function() {
        if (myWindow.closed) {
            //alert("Window Closed by Your function");
        } else if (myWindow && newwindow) {
            //alert("Window Closed by close button");
        } else {
            newwindow = true;
        }
    };
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['status'])) {
                echo "<h5 class='alert alert-success'>" . $_SESSION['status'] . "</h5>";
                unset($_SESSION['status']);
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        <form action="../DBQuery/BookQuery.php" method="POST">
                            <input type="text" name="action" class="form-control" value="search"
                                style="display:none;" />
                            <input type="text" name="condit" class="form-control" />
                            <button type="submit" name="search">Searching</button>
                        </form>
                    </h4>
                </div>
            </div>
            <hr />
            <div class="card-body">
                <div>
                    <h5><?=$book[0]['BookName_EN'];?></h5>
                    <table style="border:1px solid black;">
                        <tr>
                            <td colspan="2" rowspan="9"><img src="<?=$book[0]['img'];?>"
                                    alt="<?=$book[0]['BookName_EN'];?>" /></td>
                        </tr>
                        <tr>
                            <td>Call No.</td>
                            <td><?= $book[0]['Call_No']; ?></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                            <td><?= $book[0]['Author']; ?></td>
                        </tr>
                        <tr>
                            <td>Edition</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Publication</td>
                            <td><?= $book[0]['Publication']; ?></td>
                        </tr>
                        <tr>
                            <td>Year of Publication</td>
                            <td><?= $book[0]['Publication_Year']; ?></td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td><?= $book[0]['Subject']; ?></td>
                        </tr>
                        <tr>
                            <td>ISBN</td>
                            <td><?= $book[0]['ISBN']; ?></td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td><?= $book[0]['Language']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="5"><?=$rn;?> reservation made for this item<button onclick="Reserve()"
                                    value="reserve" style="position: relative;left:20px;"><img style="width:35px;height:35px;" src="..\static\icons\reserved.png" /></button></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
                <?php
                $len = count($stock);
                    $content = '';
                    $content .= '<table class="table table-bordered table-striped">';
                    $content .= '<tr><th>Library</th><th>Call No.</th><th>Status</th><th>Position</th></tr>';
                    for ($x=0;$x<$len;$x++){
                        $content .= '<tr><th>'.$library[$x]['Library'].'</th><th>Call No.</th><th>'.$stock[$x]['Status'].'</th><th>'.$stock[$x]['Position'].'</th></tr>';;
                    }
                    $content .= '<table>';
                echo $content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
?>