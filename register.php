<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $key = rand();

    if(isset($_POST['password']) && isset($_POST['mail']) ) {
        if( preg_match('/[a-zA-Z0-9]+@(efrei\.net|esigetel\.net|efreitech\.net)/', $_POST['mail'])) {
            $sql = "INSERT INTO re_user ( password, mail, keyActivation)
            values('" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "',
                        '" . $_POST['mail'] . "',
                        " . $key . ")";
            if ($conn->query($sql)) echo json_encode(array('success' => true));
            else echo json_encode(array('error' => 'error inserting account into databases'));
        }
        else echo json_encode(array('error' => 'not an esigetel / efrei / efreitech mail'));
    } else echo json_encode(array('error' => 'missing data'));
