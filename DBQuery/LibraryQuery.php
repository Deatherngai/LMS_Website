<?php
$action = "";
$lid = "";
$n = 0;
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $action = $_GET['action'];
    if(isset($_GET['lid'])){
        $lid = $_GET['lid'];
        $n = $_GET['n'];
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
let n = 0;
var docRef = db.collection("LMS").doc("Tables").collection("Library");
var action = "<?= $action ?>";
if (action == "info") {
    GetInfo();
} else if(action == "BQ"){
    LibraryQuery();
}

function GetInfo() {
    n = 0;
    docRef.onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            data.push(doc.data());
            n += 1;
        });
        if (n == 1) {
            str = JSON.stringify(data[0]);
        } else {
            str = JSON.stringify(data);
        }
        localStorage.setItem("info", str);
        WindowReplace();
    });
}
function LibraryQuery(){
    let qn = parseInt("<?=$n;?>");
    var lid = "<?=$lid;?>";
    docRef.where("LID","==",lid).onSnapshot((querySnapshot) => {
        querySnapshot.forEach(doc => {
            data.push(doc.data());
        });
        qn++;
        str = JSON.stringify(data[0]);
        var url = "../Temp/Library_Temp.php?action=" + action+ "&library="+str+"&n=" + qn;
        window.location.replace(url);
    });
}
function WindowReplace() {
    var info = localStorage.getItem("info");
    var url = "../public/LB_info.php?query=" + info;
    window.location.replace(url);
}
</script>