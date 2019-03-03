<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $content = trim(file_get_contents(  "php://input"));
    $decoded = json_decode($content, true);
    $key = rand();
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['mail']) ) {
        if( preg_match('/[a-zA-Z0-9]+@(efrei\.net|esigetel\.net|efreitech\.net)/', $_POST['mail'])) {
            $sql = "INSERT INTO re_user ( firstname, lastname, password, mail, keyActivation)
                        values('" . $_POST['firstname'] . "',
                        '" . $_POST['lastname'] . "',
                        '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "',
                        '" . $_POST['mail'] . "',
                         " . $key . ")";
            if ($conn->query($sql)) echo json_encode(array('success' => true));
            else echo json_encode(array('error' => 'error inserting account into databases'));
        }
        else echo json_encode(array('error' => 'not an esigetel / efrei / efreitech mail'));
    } else echo json_encode(array('error' => 'missing data'));
