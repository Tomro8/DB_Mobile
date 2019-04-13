<?php
    include('db.php');
    $sql = "select * from re_user where mail = '".$_GET['mail']."' AND keyActivation = ".$_GET['key'];
    $req = $conn->query($sql);
    if($donnee = $req->fetch())
    {
        $conn->query("update account set isActivate = true where mail = '".$_GET['mail']."'");
        echo'Votre compte à bien été re_user ! ';
    } else {
        echo 'Erreur, activation impossible';
    }

