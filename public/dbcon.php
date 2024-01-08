<?php
$SDK = $_SESSION['SDK'];
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount($SDK)
    ->withDatabaseUri('https://lbms-92247-default-rtdb.firebaseio.com/');
    $database = $factory->createDatabase()
?>