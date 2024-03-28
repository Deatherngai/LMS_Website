<?php
session_start();
$n = "";
$isbn = "";
$condit ="";
$action = "";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $action = $_GET['action'];
    if($action == "BQ"){
        if (!empty($_GET['isbn'])) {
            $isbn = $_GET['isbn'];
        }
    }else if($action == 'record' || $action == 'history'||$action == 'loan'||$action == 'loan_all'){
        $isbn = $_GET['isbn'];
    }else if($action == 'stock' || $action == 'AllStock'){
        $isbn = $_GET['isbn'];
    }
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
    if(!empty($_POST['condit'])){
        $condit = $_POST['condit'];
    }
}else{
    $action = null;
}
?>
<link href="../static/css/animation.css" rel="stylesheet">
<body translate="no" >
  <div class="loader"></div>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<script>
let data = [];
let stock = [];
let lb = [];
let ln = 0;
let rn = 0;
const qy = [];

var action = "<?= $action; ?>";
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
var str = "";
var action = "<?= $action; ?>";
var isbn = "<?= $isbn; ?>";
var condit = "<?=$condit;?>";
let n = 0;
if (action == "ListStock") {
    GetBookStoack();
} else if (action == "BQ") {
    BookQuery();
} else if (action.includes("MQ")) {
    BookMQuery();
} else if (action == "search") {
    BookSearch();
} else if (action == "record" || action == "history" || action == 'loan'||action == 'loan_all') {
    BookQuery();
} else if (action == "stock" || action == "AllStock") {
    BQByISBN(isbn);
}

function GetBookStoack() {
    var Book_Ref = db.collection("LMS").doc("Tables").collection("Book");
    Book_Ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        str = JSON.stringify(data);
        WindowsReplace();
    });
}

function BookQuery() {
    console.log(isbn);
    var Book_Ref = db.collection("LMS").doc("Tables").collection("Book").where("ISBN", "==", isbn);
    Book_Ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            console.log(doc.data);
            data.push(doc.data());
        });
        str = JSON.stringify(data);
        var url = "../Temp/Book_Temp.php?action=" + action + "&book=" + encodeURIComponent(str);
        console.log(str);
        window.location.replace(url);
    });
}

function GetReserveN() {
    var Reserv_ref = db.collection("LMS").doc("Tables").collection("Reserve").where("ISBN", "==", isbn);
    Reserv_ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            rn++;
        });
    });
}

function BookSearch() {
    n = 0;
    console.log(condit);
    var Book_Ref = db.collection("LMS").doc("Tables").collection("Book");
    Book_Ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            if (doc.data()['BookName_EN'].includes(condit)) {
                data.push(doc.data());
                //console.log(doc.data());
            }
        });
        if (data.length > 0) {
            str = JSON.stringify(data);
        } else {
            str = "null";
        }
        WindowsReplace();
    });
}

function BQByISBN(isbn) {
    console.log(isbn);
    var query = db.collection("LMS").doc("Tables").collection("Book").where("ISBN", "==", isbn);
    query.onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            data.push(doc.data());
        });
        const result = [];
        if (action.includes("kw")) {
            for (let i = 0; i < data.length; i++) {
                if (data[i]['BookName_EN'].includes(condit[2])) {
                    result.push(data[i]);
                }
            }
            str = JSON.stringify(result);
        } else {
            str = JSON.stringify(data);
        }
        console.log(str);
        WindowsReplace();
    });
}

function BookMQuery() {
    let condit = action.split("_");
    var query;
    var isbn = "";
    if (action.includes("ISBN")) {
        console.log("ISBN Query");
        for (let k = 0; k < condit.length; k++) {
            if (condit[k] == "ISBN") {
                isbn = condit[k + 1];
                k = condit.length;
                BQByISBN(isbn);
            }
        }
    } else {
        switch (condit.length) {
            case 3:
                if (!action.includes("kw")) {
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[1], "==", condit[2]);
                    console.log(condit[1]);
                    console.log(condit[2]);
                } else {
                    query = db.collection("LMS").doc("Tables").collection("Book");
                    console.log(condit[1]);
                }
                break;
            case 5:
                console.log("2Q");
                if (!action.includes("kw")) {
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[1], "==", condit[2])
                        .where(
                            condit[3], "==", condit[4]);
                } else {
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[3], "==", condit[4]);
                }
                break;
            case 7:
                console.log("3Q");
                if (!action.includes("kw")) {
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[1], "==", condit[2])
                        .where(
                            condit[3], "==", condit[4]).where(condit[5], "==", condit[6]);
                } else {
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[3], "==", condit[4])
                        .where(
                            condit[5], "==", condit[6]);
                }
                break;
            case 9:
                console.log("4Q");
                if (!action.includes("kw")) {
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[1], "==", condit[2])
                        .where(condit[3], "==", condit[4]).where(condit[5], "==", condit[6]).where(condit[7], "==",
                            condit[8]);
                } else {
                    console.log("Incules KW");
                    query = db.collection("LMS").doc("Tables").collection("Book").where(condit[3], "==", condit[4])
                        .where(condit[5], "==", condit[6]).where(condit[7], "==", condit[8]);
                }
                break;
            default:
                console.log("AQ");
                query = db.collection("LMS").doc("Tables").collection("Book").where(
                    condit[3], "==", condit[4]).where(condit[5], "==", condit[6]).where(condit[7], "==", condit[9]);
        }
        query.onSnapshot((querySnapshot) => {
            querySnapshot.forEach(doc => {
                data.push(doc.data());
            });
            console.log(data);
            const result = [];
            if (action.includes("kw")) {
                for (let i = 0; i < data.length; i++) {
                    if (data[i]['BookName_EN'].includes(condit[2])) {
                        result.push(data[i]);
                    }
                }
                str = JSON.stringify(result);
            } else {
                str = JSON.stringify(data);
            }
            console.log(condit);
            console.log(str);
            action = "MQ";
            WindowsReplace(str);
        });
    }
}

function WindowsReplace() {
    var url;
    console.log(str);
    url = "../Temp/Book_Temp.php?action=" + action + "&books=" + encodeURIComponent(str);
    window.location.replace(url);
};

function WindowsReplace2(str, n) {
    if (action == "search") {
        var url = "../public/Search_R.php?query=" + str + "&condit=" + condit + "&n=" + n;
    } else {
        var url = "../public/B_info.php?query=" + str + "&n=" + n;
    }
    window.location.replace(url);
};
</script>
</body>