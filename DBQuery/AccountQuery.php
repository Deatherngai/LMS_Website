<?php
session_start();
$ac = "";
$pw = "";
$id = "";
$n_pw= "";
$action2 = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
}else{
    $action = null;
}
if($action == "SignIn"){
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
    echo $_SESSION['AccId'];
}
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<script>
let data = [];
const firebaseConfig = {
    apiKey: "AIzaSyCwzUM4SOU7bI2LO42BvlcMNtdAJUXVh_o",
    authDomain: "lbms-92247.firebaseapp.com",
    databaseURL: "https://lbms-92247-default-rtdb.firebaseio.com",
    projectId: "lbms-92247",
    storageBucket: "lbms-92247.appspot.com",
    messagingSenderId: "1006087971603",
    appId: "1:1006087971603:web:fbcd3b1cfe993024c870e6",
    measurementId: "G-XPS9TJ6PQ5"
};
firebase.initializeApp(firebaseConfig);
var db = firebase.firestore();
var login = false;
var str = "";
var action = "<?=$action;?>";
var Account_Ref = db.collection("LMS").doc("Tables").collection("Account");
if (action == "SignIn") {
    SignIn();
} else if (action == "Up_pw") {
    UpDatePW();
} else if (action == "AM") {
    QueryAll();
}

function SignIn() {
    var query = Account_Ref.where("AccID", "==", "<?=$acc;?>").where("Password", "==",
        "<?=$pw;?>");
    query.onSnapshot((querySnapshot) => {
            if (!querySnapshot.empty) {
                querySnapshot.forEach((doc) => {
                    data.push(doc.data());
                });
                if (data.length > 0) {
                    sessionStorage.setItem("login", true);
                    console.log(sessionStorage.getItem("login"));
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
    var n_pw = "<?=$n_pw;?>";
    var statement = Account.where("AccID", "==", acc);
    statement.onSnapshot((doc) => {
        doc.update({
            Password: n_pw
        })
    });
}

function AccInfo() {
    Account.onSnapshot((query) => {
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
    Account.onSnapshot((query) => {
        query.forEach((doc) => {
            data.push(doc.data());
            n++;
        });
        str = JSON.stringify(data);
    }).catch((error) => {
        console.log("Error getting documents: ", error);
    });
}

function WindowReplace() {
    var acc = localStorage.getItem("Account");
    if (action == "AM") {
        var url = "../Temp/Account_Temp.php?action=" + action + "&accounts=" + str;
    } else if (action == "SignIn") {
        var login = sessionStorage.getItem("login");
        var url = "../Temp/Account_Temp.php?action=" + action + "&sign=" + login + "&Account=" + acc;
    }
    window.location.replace(url);
}
</script>