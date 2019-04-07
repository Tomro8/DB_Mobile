<?php

    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['id'] = 6;
    $data = array();
    $sql = "SELECT * FROM re_proposition"; //Récupère les propositions
    $req = $conn->query($sql);
    while($donnee = $req->fetch()) {
        array_push($data, $donnee);
    }
    echo(json_encode($data));

/*
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['id'] = 6;
    $sql = "SELECT * FROM re_proposition"; //Récupère les propositions
    $data = array();
    $req = $conn->query($sql);
    while($donnee = $req->fetch()) {
        //Récupère les votes positifs de la proposition
        $sqlFor = "select count(*) as nb from re_vote where id_user = ".$_SESSION['id']." AND
            id_proposition = ".$donnee['id']." AND forOrAgainst = 1";
        $reqFor = $conn->query($sqlFor);
        $for = $reqFor->fetch();
        $donnee['positive'] = $for['nb'];
        //Récupère les votes négatifs de la proposition
        $sqlAgainst = "select count(*) as nb from re_vote where id_user = ".$_SESSION['id']." AND 
            id_proposition = ".$donnee['id']." AND forOrAgainst = 0";
        $reqAgainst = $conn->query($sqlAgainst);
        $against = $reqAgainst->fetch();
        $donnee['negative'] = $against['nb'];
        $data[] = $donnee;
    }
    echo(json_encode($data));
*/

