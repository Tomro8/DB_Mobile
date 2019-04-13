<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $key = rand();
    $domain = "localhost";

    if(isset($_POST['password']) && isset($_POST['mail']) ) {
        if( preg_match('/[a-zA-Z0-9]+@(efrei\.net|esigetel\.net|efreitech\.net)/', $_POST['mail'])) {
            $req = $conn->query("SELECT * FROM re_user where mail = '".$_POST['mail']."' ");
            if(!$req->fetch()) {
                $sql = "INSERT INTO re_user ( password, mail, keyActivation)
                    values('" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "',
                    '" . $_POST['mail'] . "',
                    " . $key . ")";
                if ($conn->query($sql)) { //Insert successful
                    //Query the id
                    $req = $conn->query("SELECT id FROM re_user where mail = '".$_POST['mail']."' ");
                    $message = "Bienvenue sur revendiquons, merci de clicker ici pour activer votre compte : http://".$domain."/activate.php?mail=".
                        $_POST['mail']."&key=".$key;
                    include('email.php');
                    if ($donnees = $req->fetch()) { 
                        echo json_encode(array('success' => true, 'user_id' => $donnees['id'])); 
                    } 
                    else { echo json_encode(array('error' => 'could not fetch freshly created user id')); }
                }
                else { echo json_encode(array('error' => 'error inserting account into databases')); }
            }
            else { echo(json_encode(array('error' => 'mail already taken'))); }
        }
        else { echo json_encode(array('error' => 'not an esigetel / efrei / efreitech mail')); }
    } 
    else { echo json_encode(array('error' => 'missing data')); }
