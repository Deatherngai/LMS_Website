<?php
session_start();
$book = '';
if(isset($_SESSION['book'])){
    $book = json_decode($_SESSION['book'],true);
}
?>
<!DOCTYPE html>
<html>

<head>
    <style>
    a {
        text-decoration: none;
        color: black;
    }

    table,
    tr,
    td {
        border: 1px solid black;
    }

    .symbol {
        width: 1%;
    }

    .columns {
        width: 150px;
    }
    </style>
    <script>
    function Action() {
        let url = "../DBQuery/ReserveQuery.php?action=Reserve&isbn=" + <?= $book[0]['ISBN']; ?>;
        location.replace(url);
    }
    </script>
</head>

<body>
    <div style="text-align:center;font-size:20px;"><b>Reserve Book</b></div>
    <table style="margin:auto;">
        <tr>
            <td colspan="3" rowspan="10">image</td>
        </tr>
        <tr>
            <td class="columns">Book Name</td>
            <td class="symbol">:</td>
            <td>
                <?=$book[0]['BookName_EN']; ?>
            </td>
        </tr>
        <tr>
            <td>Call No.</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['Call_No']; ?></td>
        </tr>
        <tr>
            <td>Author</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['Author']; ?></td>
        </tr>
        <tr>
            <td>Edition</td>
            <td class="symbol">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Publication</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['Publication']; ?></td>
        </tr>
        <tr>
            <td>Year of Publication</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['Publication_Year']; ?></td>
        </tr>
        <tr>
            <td>Subject</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['Subject']; ?></td>
        </tr>
        <tr>
            <td>ISBN</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['ISBN']; ?></td>
        </tr>
        <tr>
            <td>Language</td>
            <td class="symbol">:</td>
            <td><?= $book[0]['Language']; ?></td>
        </tr>
        <tr>
            <td colspan="6"><button style="margin:auto;" onclick="Action()">Confirm</a></button><button
                    style="margin:auto;"><a href="JavaScript:window.close()">Cancel</a></button>
            </td>
        </tr>
    </table>
</body>

</html>