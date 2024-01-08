<?php
session_start();
$accID = "787235987635";
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="static/jslib/jquery-1.11.1.js"></script>
<script>
let records = [];
let books = [];
let n = 0;
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
var Stock_ref = db.collection("LMS").doc("Tables").collection("BookStock");
var Book_ref = db.collection("LMS").doc("Tables").collection("Book");
var content = "";
var isbn = "9786269593842";
var acc = "<?=$accID;?>";
Loan_ref.where('AccID', '==', acc).onSnapshot((querySnapshot) => {
    querySnapshot.forEach((doc) => {
        console.log(doc.data());
    });
});
</script>