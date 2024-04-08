<?php
session_start();
?>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>
<script src="static/jslib/jquery-1.11.1.js"></script>
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
var docRef = db.collection("LMS").doc("Tables").collection("Account");
var query = docRef.where("AccID", "==", <?=$_POST['account'];?>);
var str = "";
query.onSnapshot((querySnapshot) => {
    querySnapshot.forEach(doc => {
        data.push(doc.data());
    });
});
</script>