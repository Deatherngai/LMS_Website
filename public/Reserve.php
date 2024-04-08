<?php
session_start();
$book = '';
$library = '';
if(isset($_SESSION['book'])){
    $book = json_decode($_SESSION['book'],true);
    $library = json_decode($_SESSION['library'],true);
}
$_SESSION['Reserve'] = "false";
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
</head>

<body>
<p id=" info" style="display:none;"><?= $Info; ?></p>
                <div style="text-align:center;font-size:20px;"><b>Reserve Book</b></div>
                <table style="margin:auto;text-align: center;vertical-align: middle;s">
                    <tr><td colspan="3"><img src="<?=$book[0]['img'];?>" alt="<?=$book[0]['BookName_EN'];?>" /></td></tr>
                    <tr><td class="columns">Book Name</td><td>:</td><td><?=$book[0]['BookName_EN']; ?></td></tr>
                    <tr><td>Call No.</td><td>:</td><td><?= $book[0]['Call_No']; ?></td></tr>
                    <tr><td>Author</td><td>:</td><td><?= $book[0]['Author']; ?></td></tr>
                    <tr><td>Edition</td><td>:</td><td></td></tr>
                    <tr><td>Publication</td><td>:</td><td><?= $book[0]['Publication']; ?></td></tr>
                    <tr><td>Year of Publication</td><td>:</td><td><?= $book[0]['Publication_Year']; ?></td></tr>
                    <tr><td>Subject</td><td>:</td><td><?= $book[0]['Subject']; ?></td></tr>
                    <tr><td>ISBN</td><td>:</td><td><?= $book[0]['ISBN']; ?></td></tr>
                    <tr><td>Language</td><td>:</td><td><?= $book[0]['Language']; ?></td></tr>
                    <tr><td>Pick up location</td><td>:</td><td>
                        <?php
                            $len = count($library);
                            $str = '<select name="lib" id="libs">';
                            for($i=0;$i<$len;$i++){
                                if(!strpos($str,$library[$i]['LID'])){
                                    $str .='<option value="'.$library[$i]['LID'].'">'.$library[$i]['Library'].'</option>';
                                }
                            }
                            $str .='</select>';
                            echo $str;
                        ?></td>
                    </tr><tr><td colspan="6"><b>Note:<br />You should pay HK$2 for reserve a book!<br />The free would be charged whenyou pick up the book.</b></td></tr>
                    <tr><td colspan="6"><button style="margin:auto;" onclick="Action()">Confirm</a></button><button style="margin:auto;"><a href="JavaScript:window.close()">Cancel</a></button></td>
                    </tr>
                </table>
    <script>
    function Action() {
        var lib = document.getElementById("libs").value;
        let url = "../DBQuery/ReserveQuery.php?action=Reserve&isbn=" + <?= $book[0]['ISBN']; ?> + "&lib=" + lib;
        location.replace(url);
    }
    </script>
</body>
</html>