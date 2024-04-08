<?php
session_start();
$_SESSION['login'] = 'false';
$_SESSION['action']='ListStock';
$_SESSION['r']='';
?>
<link href="./static/css/animation.css" rel="stylesheet">
<body translate="no" >
  <div class="loader"></div>
</body>
<script>
window.location.replace("./DBQuery/BookQuery.php?action=ListStock");
</script>