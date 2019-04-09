<?php

    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $sql = "delete FROM re_proposition where id = ".$_POST['id'];
    $req = $conn->exec($sql);
    echo(json_encode(array('success' => true)));


