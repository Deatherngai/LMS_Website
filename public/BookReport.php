<?php
include('includes/header.php');
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
</style>
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
                    <h4>Book Reports</h4>
                </div>
            </div>
            <div class="card-body">
                <?php
                    $reports = json_decode($_SESSION['report'],true);
                    for($i=0;$i<count($reports);$i++){
                        $content = '<table><tr><td rowspan="8"><img src="'.$reports[$i]['img'].'"/></td></tr>';
                        $content .= '<tr><td>BookName</td><td>:</td><td>'.$reports[$i]['BookName_EN'].'</td></tr>';
                        $content .= '<tr><td>Author</td><td>:</td><td>'.$reports[$i]['Author'].'</td></tr>';
                        $content .= '<tr><td>Publisher</td><td>:</td><td>'.$reports[$i]['Publication'].'</td></tr>';
                        $content .= '<tr><td>Publish Year</td><td>:</td><td>'.$reports[$i]['Public Year'].'</td></tr>';
                        $content .= '<tr><td>Subject</td><td>:</td><td>'.$reports[$i]['Subject'].'</td></tr>';
                        $content .= '<tr><td>Language</td><td>:</td><td>'.$reports[$i]['Language'].'</td></tr>';
                        $content .= '<tr><td>ISBN</td><td>:</td><td>'.$reports[$i]['ISBN'].'</td></tr>';
                        $content .= '<tr><td colspan="4">Reader Feeling:<br />'.$reports[$i]['Feeling'].'</td></tr>';
                        $content .= '</table><br />';
                    }
                    echo $content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>