<?php
    $dbName = 'revendiquons';
    $user = 'root';
    $password = '';
    $host = 'localhost';
//    echo "";
    if(!isset($conn)) {
        $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $user, $password);	// try to connect if it doesn't work, may be
    }
