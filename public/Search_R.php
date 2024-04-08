<?php
include('includes/header.php');
$books = "";
$condit = "";
$n = 0;
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
}
?>
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
                        <form action="../DBQuery/BookQuery.php" method="POST">
                            <input type="text" name="action" class="form-control" value="search"
                                style="display:none;" />
                            <input type="text" name="condit" class="form-control" />
                            <button type="submit" name="search">Searching</button>
                        </form>
                    </h4>
                </div>
            </div>
            <div class="card-body" id="result">
                <?php
                    $books = $_SESSION['QList'];
                    $content = "";
                    $collect = json_decode($books,true);
                    $len = count($collect);
                    $n=1;
                    if($len>0){
                        $content = '<table class="table table-bordered table-striped"><tr><th>S1.no</th><th>Book Name</th><th>Author</th><th>Publication</th><th>Publication Year</th></tr>';
                        for ($x=0;$x<$len;$x++){
                            $content.= '<tr><td>'.$n.'</td><td><a href="../DBQuery/BookQuery.php?action=BQ&isbn='.$collect[$x]['ISBN'].'">'.$collect[$x]['BookName_EN'].'</td><td>'.$collect[$x]['Author'].'</td><td>'.$collect[$x]['Publication'].'</td><td>'.$collect[$x]['Publication_Year'].'</td></tr>';
                            $n++;
                        }
                        $content .= '</table>';
                    }else{
                        $content='Sorry, can not find the related stock';
                    }
                    echo $content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php')
?>