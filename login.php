<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $key = rand();
    if(isset($_POST['password']) && isset($_POST['mail']) ) {
        //Get user data
        $sql = "select * from re_user where mail = '".$_POST['mail']."'";
        $req = $conn->query($sql);
        if ($donnee = $req->fetch()) {
            //Chech that user account is activated
            if ($donnee['isActivate'] == 1) {
                if(password_verify($_POST['password'], $donnee['password'])) {
                    $_SESSION['id'] = $donnee['id'];
                    $_SESSION['mail'] = $donnee['mail'];
                    echo json_encode(array('success' => true, 'user_id' => $donnee['id']));
                } else { echo json_encode(array('error' => 'wrong password')); }       
            } else { echo json_encode(array('error' => 'account not activated')); }
        } else { echo json_encode(array('error' => 'user not exist')); }
    } else { echo json_encode(array('error' => 'missing data')); }


