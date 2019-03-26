<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['id'] = 6;

    if(isset($_POST['id']) && isset($_POST['forOrAgainst']) ) {
        $remSQL = "delete from re_vote where id_user = ".$_SESSION['id']." AND id_proposition = ".$_POST['forOrAgainst'];
        $conn->exec($remSQL);
        $sql = "insert into re_vote (id_user, id_proposition, forOrAgainst) values( ".$_SESSION['id'].", '".$_POST['id']."', ".$_POST['forOrAgainst'].")";
        if ($conn->query($sql)) echo json_encode(array('success' => true));
        else echo json_encode(array('error' => 'error inserting account into databases'));
    } else echo json_encode(array('error' => 'missing data'));
