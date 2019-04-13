<?php
    include('db.php');
    $sql = "SELECT * FROM re_user WHERE mail = '".$_GET['mail']."' AND keyActivation = ".$_GET['key'];
    $req = $conn->query($sql);
    if($donnee = $req->fetch()) {
        $conn->query("UPDATE re_user SET isActivate = 1 WHERE mail = '".$_GET['mail']."'");
        echo 'Votre compte à bien été activé !';
    } else {
        echo 'Erreur, activation impossible';
    }

