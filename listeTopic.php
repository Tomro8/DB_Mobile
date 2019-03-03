<?php

    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['id'] = 6;
    $content = trim(file_get_contents(  "php://input"));
    $sql = "SELECT * FROM re_ticket";
    $data = array();
    $req = $conn->query($sql);
    while($donnee = $req->fetch()) {
        $sqlFor = "select count(*) as nb from re_vote_ticket where id_user = ".$_SESSION['id']." AND id_ticket = ".$donnee['id']." AND forOrAgainst = 1";
        $reqFor = $conn->query($sqlFor);
        $for = $reqFor->fetch();
        $donnee['for'] = $for['nb'];
        $sqlAgainst = "select count(*) as nb from re_vote_ticket where id_user = ".$_SESSION['id']." AND id_ticket = ".$donnee['id']." AND forOrAgainst = 0";
        $reqAgainst = $conn->query($sqlAgainst);
        $against = $reqAgainst->fetch();
        $donnee['against'] = $against['nb'];
        $data[] = $donnee;

    }
    echo(json_encode($data));


