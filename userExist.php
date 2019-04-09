<?php

    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    if(isset($_POST['mail']) ) {
        $req = $conn->query("SELECT * FROM re_user where mail = '".$_POST['mail']."' ");
        if($donnee = $req->fetch()) echo(json_encode(array('exist' => true)));
        else echo(json_encode(array('exist' => false)));
    } else echo json_encode(array('error' => 'missing data'));


