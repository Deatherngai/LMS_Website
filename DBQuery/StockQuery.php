<?php
session_start();
$records = "";
$action = "";
$BID = '';
$isbn="";
$lid='';
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if($action == 'BQ'){
        $records = $_SESSION['book'];
        $records = json_decode($records,true);
        $isbn = $records[0]['ISBN'];
    }else if($action == 'record' || $action == 'history'|| $action == 'loan'){
        $BID = $_GET['BID'];
    }else if($action == 'stock'){
        $lid = $_GET['lid'];
    }
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
var Reser_Ref = db.collection("LMS").doc("Tables").collection("BookStock");

var action = "<?=$action;?>";
if (action == "BQ") {
    StockQueryByISBN();
} else if (action == "record" || action == "history" || action == 'loan') {
    StockQueryByID();
} else if (action == 'stock') {
    StockQueryByLib();
}

function StockQueryByISBN() {
    let data = [];
    var isbn = "<?=$isbn;?>";
    Reser_Ref.where("ISBN", "==", isbn).onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        var str = JSON.stringify(data);
        var url = "../Temp/Stock_Temp.php?action=" + action + "&stock=" + str;
        window.location.replace(url);
    });
}

function StockQueryByID() {
    let data = [];
    var id = "<?=$BID;?>"
    Reser_Ref.where("BID", "==", id).onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        var str = JSON.stringify(data);
        var url = "../Temp/Stock_Temp.php?action=" + action + "&stock=" + str;
        window.location.replace(url);
    });
}

function StockQueryByLib() {
    let data = [];
    var id = "<?=$lid;?>"
    if (id == "") {
        Reser_Ref.onSnapshot((querySnapshot) => {
            querySnapshot.forEach((doc) => {
                data.push(doc.data());
            });
            var str = JSON.stringify(data);
            var url = "../Temp/Stock_Temp.php?action=" + action + "&stock=" + str;
            window.location.replace(url);
        });
    } else {
        Reser_Ref.where("LID", "==", id).onSnapshot((querySnapshot) => {
            querySnapshot.forEach((doc) => {
                data.push(doc.data());
            });
            var str = JSON.stringify(data);
            var url = "../Temp/Stock_Temp.php?action=" + action + "&stock=" + str;
            window.location.replace(url);
        });
    }
}
</script>