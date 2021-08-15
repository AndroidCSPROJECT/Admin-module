<?php

require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;

$factory = (new Factory)->withServiceAccount('bold-zoo-303509-firebase-adminsdk-5wig0-9ba283b9f9.json')
->withDatabaseUri('https://bold-zoo-303509-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();
?>