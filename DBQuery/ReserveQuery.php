<?php
session_start();
$isbn = '';
$action = '';
$AccID = '';
$id = '';
$exsit = '';
if(isset($_SESSION['Account'])){
    $account = json_decode($_SESSION['Account'],true);
    $AccID = $account[0]['AccID'];
}
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $action = $_GET['action'];
    if(!empty($_GET['isbn'])){
        $isbn = $_GET['isbn'];
        $_SESSION['R_isbn'] = $isbn;
    }
    if(isset($_SESSION['id_exist']) && isset($_SESSION['R_ID'])){
        $exist = $_SESSION['id_exist'];
        $id = $_SESSION['R_ID'];
        $isbn = $_SESSION['R_isbn'];
    }
}
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<script>
let data = [];
let n = 0;
let exist = true;
var rid = '';
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
var Reser_Ref = db.collection("LMS").doc("Tables").collection("Reserve");

var action = "<?= $action; ?>";
var id = "<?= $id; ?>";
var exist = "<?= $exist; ?>";
if (action == "Reserve") {
    GenerateID()
}

function AddReserve() {
    var docData = {
        ApplyDate: ,
        ISBN: "<?=$isbn;?>";
        RD: rid
    }
    var query = Reser_Ref.doc().set(docData).then(() => {
        console.log("Document successfully written!");
    });
}

function GenerateID() {
    let x = Math.floor((Math.random() * 100000) + 1);
    rid = 'R' + x;
    var query = Reser_Ref.where(rid);
    query.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        n = data.length();
        ChekcIDRepeat();
    });
}

function ChekcIDRepeat() {
    if (n < 0 || n == 0) {
        AddReserve();
    } else {
        GenerateID();
    }
}

function WindowsReplace() {
    var url = '';
}
</script>