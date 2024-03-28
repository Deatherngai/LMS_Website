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
                    <h4>Book Reports</h4>
                </div>
            </div>
            <div class="card-body">
            <table>
                    <tr><td rowspan="8">Book Image</td></tr>
                    <tr><td>BookName</td><td>:</td><td><input type="text" name="name" id="name" /></td></tr>
                    <tr><td>Author</td><td>:</td><td><input type="text"
                                name="author" id="author" /></td></tr>
                    <tr><td>Publisher</td><td>:</td><td><input type="text"
                                name="publisher" id="publisher" /></td></tr>
                    <tr><td>Publish Year</td><td>:</td><td><input type="text"
                                name="year" id="year" /></td></tr>
                    <tr><td>Subject</td><td>:</td><td><input type="text"
                                name="sub" id="sub" /></td></tr>
                    <tr><td>Language</td><td>:</td><td><input type="text"
                                name="lang" id="lang" /></td></tr>
                    <tr><td>ISBN</td><td>:</td><td><input type="text"
                                name="isbn" id="isbn" /></td></tr>
                    <tr><td colspan="3">Reader Feeling:</td></tr>
                    <tr><td colspan="3"></tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php')
?>