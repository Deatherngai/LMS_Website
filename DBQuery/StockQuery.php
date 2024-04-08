<?php
session_start();
$records = "";
$action = "";
$BID = '';
$isbn="";
$lid='';
$status = '';
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    if($action == 'BQ'){
        $records = $_SESSION['book'];
        $records = json_decode($records,true);
        $isbn = $records[0]['ISBN'];
    }else if($action == 'record' || $action == 'history'|| $action == 'loan' ||  $action == 'loan_all'){
        $BID = $_GET['BID'];
    }else if($action == 'stock'){
        $lid = $_GET['lid'];
    }else if($action=="Status_CH" || $action=="Status_CH_Ad"){
        $BID = $_GET['bid'];
        $status = $_GET['status'];
    }
}
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
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
var Reser_Ref = db.collection("LMS").doc("Tables").collection("BookStock");

var action = "<?=$action;?>";
if (action == "BQ") {
    StockQueryByISBN();
} else if (action == "record" || action == "history" || action == "loan" || action == "loan_all") {
    StockQueryByID();
} else if (action == 'stock') {
    StockQueryByLib();
} else if (action == 'AllStock') {
    StockQueryAll();
} else if (action == "Status_CH" || action == "Status_CH_Ad") {
    StockUpdate();
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
    var id = "<?=$BID;?>";
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
    var id = "<?=$lid;?>";
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

function StockQueryAll() {
    let data = [];
    Reser_Ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        var str = JSON.stringify(data);
        var url = "../Temp/Stock_Temp.php?action=" + action + "&stock=" + str;
        window.location.replace(url);
    });
}

function StockUpdate() {
    var first = true;
    var statement = Reser_Ref.where("BID", "==", "<?=$BID;?>");
    console.log("<?=$BID;?>");
    statement.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            if (first == true) {
                Reser_Ref.doc(doc.id).update({
                    Status: "<?=$status;?>",
                    ModifyDate: new Date()
                }).then(() => {
                    console.log("Document successfully updated!");
                    var url = "";
                    if(action == "Status_CH"){
                        url = 'StaffQuery.php?action=stock';
                    }else{
                        url = 'LibraryQuery.php?action=AllStock';
                    }
                    window.location.replace(url);
                }).catch((error) => {
                    console.error("Error updating document: ", error);
                });
            }
        });
    });
}
</script>