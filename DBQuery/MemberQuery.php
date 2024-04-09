<?php
session_start();
$action ='';
if(isset($_SESSION['Account'])){
    $account = json_decode($_SESSION['Account'],true);
    $AccID = $account[0]['AccID'];
}
if($_SERVER['REQUEST_METHOD'] == "GET"){
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
var str = "";
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
var Staff_ref = db.collection("LMS").doc("Tables").collection("Member");
var action = "<?=$action;?>"
StaffIn();

function StaffIn() {
    var id = "<?=$AccID;?>";
    var query = Staff_ref.where('AccID', '==', id);
    query.onSnapshot((querySnapshot) => {
        querySnapshot.forEach((doc) => {
            data.push(doc.data());
        });
        str = JSON.stringify(data);
        WindowReplace();
    });
}

function WindowReplace() {
    var url = '../Temp/Member_Temp.php?action=' + action + '&info=' + str;
    window.location.replace(url);
}
</script>