<?php
include('includes/header.php');
?>
<script>
$(document).ready(function() {
    $(document).prop('title', 'Home');
    var login = "<?= $_SESSION['login']; ?>";
    const stock = eval($("#bookStock").text());
    var content = "";
    var n = 1;
    for (let i = 0; i < stock.length; i++) {
        var a_tag = "<a href='./DBQuery/BookQuery.php?action=BQ&isbn=" + stock[i].ISBN + "'>" + stock[i]
            .BookName_EN +
            "</a>";
        content += "<tr><td>" + n + "</td>";
        content += "<td>" + a_tag + "</td>";
        content += "<td>" + stock[i].Author + "</td>";
        content += "<td>" + stock[i].Publication + "</td>";
        content += "<td>" + stock[i].Publication_Year + "</td>";
        content += "</tr>";
        n++;
    }
    $("#img").html(stock[0].img);
    $("#list").html(content);

});
</script>
<p id="bookStock" style="display:none;"><?= $_SESSION['BookStock']; ?></p>
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
                        <form action="./DBQuery/BookQuery.php" method="POST">
                            <input type="text" name="action" class="form-control" value="search"
                                style="display:none;" />
                            <div id="search">
                                <input type="text" name="condit" class="form-control" />
                            </div>
                            <div class="search_btn">
                                <button type="submit" name="search" id="btn_s"><img src="static\icons\search.png" style="width:30px;height:30px;"></button>
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
<?php
include('includes/footer.php')
?>