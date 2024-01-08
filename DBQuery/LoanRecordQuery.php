<?php
session_start();
$acc = "";
$action = "";
$AccID= "";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $action = $_GET['action'];
}
echo $_SESSION['Account'];
$account = json_decode($_SESSION['Account'],true);
$AccID = $account[0]['AccID'];
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<script>
var action = "<?=$action;?>";
var id = "<?=$AccID;?>";
const records = [];
var str = "";
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
var Loan_ref = db.collection("LMS").doc("Tables").collection("LoadRecord");

if (action == "record") {
    console.log('record');
    LoanRecord();
} else if (action == "history") {
    console.log('history');
    LoanHistory();
}else if(action == 'loan'){
    console.log('loan');
    QueryAllLoan();
}

function LoanRecord() {
    var query = Loan_ref.where("AccID", "==", id).where("Return", "==", false);
    query.onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            console.log(doc.data());
            records.push(doc.data());
        });
        str = JSON.stringify(records);
        Show();
    });
}

function LoanHistory() {
    var query = Loan_ref.where("AccID", "==", id).where("Return", "==", true);
    query.onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            records.push(doc.data());
        });
        str = JSON.stringify(records);
        Show();
    });
}

function QueryAllLoan() {
    Loan_ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            records.push(doc.data());
        });
        str = JSON.stringify(records);
        Show();
    });
}

function Show() {
    console.log(str);
    var url = "../Temp/Loan_Temp.php?action=" + action + "&records=" + str;
    window.location.replace(url);
}
</script>