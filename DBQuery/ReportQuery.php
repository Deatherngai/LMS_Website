<<<<<<< HEAD
<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
}else{
    $action = $_GET['action'];
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
var login = false;
var str = "";
var action = "<?=$action;?>";
var Report_Ref = db.collection("LMS").doc("Tables").collection("BookReport");
if (action == "report") {
    ShowReports();
}

function ShowReports(){
    Report_Ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        str = JSON.stringify(data);
        WindowReplace();
    });
}

function WindowReplace(){
    console.log(str);
    var url = "../Temp/Report_Temp.php?action="+action+"&reports="+(str);
    window.location.replace(url);
}
</script>
=======
<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
}else{
    $action = $_GET['action'];
}
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<link href="../static/css/animation.css" rel="stylesheet">
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
var Report_Ref = db.collection("LMS").doc("Tables").collection("BookReport");
if (action == "report") {
    ShowReports();
}

function ShowReports(){
    Report_Ref.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        str = JSON.stringify(data);
        WindowReplace();
    });
}

function WindowReplace(){
    console.log(str);
    var url = "../Temp/Report_Temp.php?action="+action+"&reports="+(str);
    window.location.replace(url);
}
</script>
>>>>>>> ff63cd86e8e6c58959edc116977b4be8c5a790eb
</body>