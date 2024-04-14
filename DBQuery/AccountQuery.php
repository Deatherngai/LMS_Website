<?php
session_start();
$acc = "";
$pw = "";
$id = "";
$n_pw= "";
$action2 = "";
unset($_SESSION['login2']);
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
}else{
    $action = $_GET['action'];
}
if($action == "SignIn" || $action == "reserve"){
    $acc = $_POST['account'];
    $pw = $_POST['password'];
    $_SESSION['AccId'] = $_POST['account'];
}else if($action == "Up_pw"){
    $n_pw = $_POST['password'];
    $acc = $_SESSION['AccId'];
}else if($action == "info"){
    $acc = $_SESSION['AccId'];
}else if($action == "AM"){
    $acc = $_SESSION['AccId'];
}
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="https://cdn.bootcss.com/blueimp-md5/2.12.0/js/md5.min.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<link href="../static/css/animation.css" rel="stylesheet" />
<body translate="no" >
  <div class="loader"></div>
<script>
let data = [];
const firebaseConfig = {
    apiKey: "AIzaSyBEh1u6MzDrqwIG1v5hVj9lAVV-L5oZeOg",
    authDomain: "lms1-f35b6.firebaseapp.com",
    projectId: "lms1-f35b6",
    storageBucket: "lms1-f35b6.appspot.com",
    messagingSenderId: "738390066815",
    appId: "1:738390066815:web:e8ebb8e7e27c0fc929a14a",
    measurementId: "G-98Z76SNL3Q"
  };
firebase.initializeApp(firebaseConfig);
var db = firebase.firestore();
var login = false;
var str = "";
var action = "<?=$action;?>";
var Account_Ref = db.collection("LMS").doc("Tables").collection("Account");
if (action == "SignIn" || action == "reserve") {
    SignIn();
} else if (action == "Up_pw") {
    UpDatePw();
} else if (action == "AM") {
    QueryAll();
}

function SignIn() {
    var query = Account_Ref.where("AccID", "==", "<?=$acc;?>").where("Password", "==",window.btoa("<?=$pw;?>"));
    query.onSnapshot((querySnapshot) => {
            if (!querySnapshot.empty) {
                querySnapshot.forEach((doc) => {
                    data.push(doc.data());
                });
                if (data.length > 0) {
                    sessionStorage.setItem("login", true);
                    localStorage.setItem("Account", JSON.stringify(data));
                    WindowReplace();
                } else {
                    sessionStorage.setItem("login", false);
                }
            } else {
                sessionStorage.setItem("login", false);
                WindowReplace();
            }
        })
        .catch((error) => {
            console.log("Error getting documents: ", error);
        });
}

function UpDatePw() {
    var acc = "<?=$acc;?>";
    var n_pw = window.btoa("<?=$n_pw;?>");
    var statement = Account_Ref.where("AccID", "==", acc);
    statement.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            Account_Ref.doc(doc.id).update({
                    Password: n_pw
                })
                .then(() => {
                    console.log("Document successfully updated!");
                    alert("The Account password has successfully updated! <br> The account will be sign out!");
                    window.location.href = "../index.php";
                })
                .catch((error) => {
                    // The document probably doesn't exist.
                    console.error("Error updating document: ", error);
                    alert("The Account password doesn't successfully updating! Please try again");
                    window.location.href = "../public/pw_m.php";
                });
        });
    });
}

function AccInfo() {
    Account_Ref.onSnapshot((query) => {
        query.forEach((doc) => {
            data.push(doc.data());
            n++;
        });
        var str = JSON.stringify(data);
        localStorage.setItem("Account", str);
        WindowReplace();
    }).catch((error) => {
        console.log("Error getting documents: ", error);
    });
}

function QueryAll() {
    n = 0;
    Account_Ref.onSnapshot((query) => {
        query.forEach((doc) => {
            data.push(doc.data());
            n++;
        });
        str = JSON.stringify(data);
        WindowReplace();
    });
}

function WindowReplace() {
    var url = "";
    if (action == "AM") {
        url = "../Temp/Account_Temp.php?action=" + action + "&accounts=" + str;
    } else if (action == "SignIn" || action == "reserve") {
        var acc = localStorage.getItem("Account");
        var login = sessionStorage.getItem("login");
        url = "../Temp/Account_Temp.php?action=" + action + "&sign=" + login + "&Account=" + acc;
    } else if (action == "Up_pw") {
        url = "../index2.php";
    }
    window.location.replace(url);
}
</script>
</body>