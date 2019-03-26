<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $key = rand();
    if(isset($_POST['password']) && isset($_POST['mail']) ) {
        $sql = "select * from re_user where mail = '".$_POST['mail']."'";
        if ( $req = $conn->query($sql)) {
            $donnee = $req->fetch();
            echo json_encode($donnee);
            if(password_verify($_POST['password'], $donnee['password'])) {
                $_SESSION['id'] = $donnee['id'];
                $_SESSION['mail'] = $donnee['mail'];
                echo json_encode(array('success' => true));
            } echo json_encode(array('error' => 'wrong password'));
        } else echo json_encode(array('error' => 'user not exist'));
    } else echo json_encode(array('error' => 'missing data'));


