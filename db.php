<?php
    $dbName = 'rdb';
    $user = 'rdb';
    $password = '123456789.';
    $host = 'rdb.cqhlc7xonrl4.us-east-2.rds.amazonaws.com';
//    echo "";
    if(!isset($conn)) {
        $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $user, $password);	// try to connect if it doesn't work, may be
    }
