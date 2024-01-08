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
echo $AccID;
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="../static/jslib/jquery-1.11.1.js"></script>
<script>
let data = [];
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
var Staff_ref = db.collection("LMS").doc("Tables").collection("Staff");
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
    var url = '../Temp/Staff_Temp.php?action=' + action + '&info=' + str;
    window.location.replace(url);
}
</script>