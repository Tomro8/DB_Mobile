<?php

    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['id'] = 6;
    $sql = "SELECT * FROM re_proposition";
    $data = array();
    $req = $conn->query($sql);
    while($donnee = $req->fetch()) {
        $sqlFor = "select count(*) as nb from re_vote where id_user = ".$_SESSION['id']." AND 
            id_proposition = ".$donnee['id']." AND forOrAgainst = 1";
        $reqFor = $conn->query($sqlFor);
        $for = $reqFor->fetch();
        $donnee['for'] = $for['nb'];
        $sqlAgainst = "select count(*) as nb from re_vote where id_user = ".$_SESSION['id']." AND 
            id_proposition = ".$donnee['id']." AND forOrAgainst = 0";
        $reqAgainst = $conn->query($sqlAgainst);
        $against = $reqAgainst->fetch();
        $donnee['against'] = $against['nb'];
        $data[] = $donnee;
    }
    echo(json_encode($data));


