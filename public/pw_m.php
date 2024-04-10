<?php
include('includes/header.php');
$info = "";
$n = "";
$acc = "";
$pw = "";
$acc = json_decode($_SESSION['Account'] ,true);
$pw = $acc[0]['Password'];
?>
<h1 id="t"></h1>
<p id=" info" style="display:none;"><?= $Info; ?></p>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Password Update</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="frame">
                    <div>
                        <form id="UpdatePW" action="../DBQuery/AccountQuery.php" method="POST">
                            <input type="text" id="action" name="action" value="Up_pw" style="display:none;" />
                            <input type="text" id="up_pw" name="password" style="display:none;" />
                            <button type="submit" id="submit" style="display:none;">Submit</button>
                        </form>
                    </div>
                    <div style="margin:auto;margin-top:40px;">
                        <table id="pw_edit" style="margin:auto;margin-top:40px;">
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                    <div style="text-align:center;" id="error_msg">Message</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td>Original Password</td>
                                <td>:</td>
                                <td><input type="password" id="init_pw" name="init_pw"></td>
                            </tr>
                            <tr>
                                <td>New Password</td>
                                <td>:</td>
                                <td><input type="password" id="new_pw" name="new_pw" onchange="DoubleInsert()"></td>
                            </tr>
                            <tr>
                                <td>Confirm Passord</td>
                                <td>:</td>
                                <td><input type="password" id="con_pw" name="con_pw" onchange="DoubleInsert()">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div style="display: flex;" class="d-flex justify-content-evenly">
                                        <button onclick="CheckMatch()">UpDate</button><button>Canel</button>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var match = false;
var confirm = false;
var n_pw = "";
var msg = "";

function CheckMatch() {
    msg = "";
    DoubleInsert();
    var or_pw = document.getElementById("init_pw").value;
    var pw = "<?=$pw;?>";
    if (or_pw == pw) {
        if (confirm) {
            if (or_pw == n_pw) {
                msg +=
                    "<label style='color:red;'><b>The new password can not same as the orignal password!</b></label>";
                document.getElementById("error_msg").innerHTML = msg;
            } else {
                document.getElementById("up_pw").value = document.getElementById("con_pw").value;
                document.getElementById("submit").click();
            }
        } else {
            document.getElementById("up_pw").value = "";
            msg += "<label style='color:red;'><b>The new password and confirm password are not same!</b></label>";
            document.getElementById("error_msg").innerHTML = msg;
        }
    } else {
        if (confirm) {
            msg +=
                "<label style='color:red;'><b>The original password is not match the Account's current password!</b></label>";
            document.getElementById("error_msg").innerHTML = msg;
        } else {
            msg +=
                "<label style='color:red;'><b>The original password is not match the Account's current password!</b></label><br/>";
            msg += "<label style='color:red;'><b>The new password and confirm password are not same!</b></label>";
            document.getElementById("error_msg").innerHTML = msg;
        }
    }
    console.log(msg);
}

function DoubleInsert() {
    confirm = false;
    n_pw = document.getElementById("new_pw").value;
    var c_pw = document.getElementById("con_pw").value;
    if (c_pw != "" || n_pw != "") {
        if (c_pw == n_pw) {
            confirm = true;
        } else {
            confirm = false;
        }
    }
    console.log(confirm);
}
</script>
<?php
    include('../includes/footer.php');
?>