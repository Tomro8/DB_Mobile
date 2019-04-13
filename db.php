<?php
    $dbName = 'revendiquons';
    $user = 'admin';
    $password = '688e24f00231b5a1f5df0fd9b80a6e73640fc9f3656625be';
    $host = 'localhost';
//    echo "";
    if(!isset($conn)) {
        $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $user, $password);	// try to connect if it doesn't work, may be
    }
