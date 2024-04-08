<?php
include('includes/header.php');
?>
<style>
#tb {
    border-spacing: 10px 15px;
    border-style: outset;
}

.form-control {
    width: 400px;
}

.as_btn {
    width: 150px;
    height: 50px;
    color: black;
    font-size: 20px;
    outline: none;
    background-color: #40E0D0;
    border: none;
    border-radius: 5px;
}

@media (max-width:576px) {
    .form-control {
        width: 200px;
    }

    #tb {
        flex: 1 0 0%;
        border-spaceing: 10px 10px;
        margin-bottom: 0;
    }

    .as_btn {
        width: 100px;
        height: 35px;
        color: white;
        font-size: 15px;
        outline: none;
        color: #fff;
        background-color: #0d6efd;
        border: none;
        border-radius: 5px;
    }
}
</style>
<script>
function validateForm() {
    var action = "MQ";
    var kw = document.forms["SForm"]["kw"].value;
    var author = document.forms["SForm"]["author"].value;
    var public = document.forms["SForm"]["public"].value;
    var subject = document.forms["SForm"]["subject"].value;
    var isbn = document.forms["SForm"]["isbn"].value;
    if (kw != "") {
        action += "_kw_" + kw;
    }
    if (author != "") {
        action += "_Author_" + author;
    }
    if (public != "") {
        action += "_Publication_" + public;
    }
    if (subject != "") {
        action += "_Subject_" + subject;
    }
    if (isbn != "") {
        action += "_ISBN_" + isbn;
    }
    let result = action.includes("_");
    if (result) {
        $("#action").val(action);
        return true;
    } else {
        $("#msg").css("display", "");
        $("#msg").html("Please Inserting at least once searching condition!");
        return false;
    }

}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align:center;">
                    <h3>Library Information</h3>
                </div>
            </div>
            <div class="card-body" id="tb">
                <form name="SForm" action="../DBQuery/BookQuery.php" onsubmit="return validateForm()" method="POST"
                    required>
                    <input type="hidden" id="action" name="action" value="MQ" />
                    <p id="msg" style="text-align:center; color:red; font-size:25px;display:none;">Error Message</p>
                    <table style="margin-left: auto;margin-right: auto;">
                        <tr>
                            <td><label>Book Name</label></td>
                            <td>:</td>
                            <td><input type="text" name="kw" id="kw" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>Author</label></td>
                            <td>:</td>
                            <td><input type="text" name="author" id="author" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td><label>Publication</label></td>
                            <td>:</td>
                            <td><input type="text" name="public" id="public" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td><label>Subject</label></td>
                            <td>:</td>
                            <td><input type="text" name="subject" id="subject" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td><label>ISBN</label></td>
                            <td>:</td>
                            <td><input type="text" name="isbn" id="isbn" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div style="display: flex;" class="d-flex justify-content-evenly"><button type="reset"
                                        class="as_btn">Reset</button><button type="submit"
                                        class="as_btn">Search</button></div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php')
?>