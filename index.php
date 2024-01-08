<?php
session_start();
$_SESSION['login'] = 'false';
$_SESSION['action']='ListStock';
$_SESSION['r']='';
?>
<script>
window.location.replace("./DBQuery/BookQuery.php?action=ListStock");
</script>