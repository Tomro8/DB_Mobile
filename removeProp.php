<?php

    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $content = trim(file_get_contents(  "php://input"));
    $sql = "delete FROM re_proposition where id = ".$_POST['id'];
    $req = $conn->exec($sql);
    echo(json_encode(array('success' => true)));


