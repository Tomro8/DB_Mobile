<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");

    if(isset($_POST['user_id']) && isset($_POST['prop_id']) && isset($_POST['forOrAgainst']) ) {
        //Remove any existing vote for the user for that proposition
        $remSQL = "delete from re_vote where id_user = ".$_POST['user_id']." AND id_proposition = ".$_POST['prop_id'];
        $conn->exec($remSQL);

        //Insert new vote
        $sql = "insert into re_vote (id_user, id_proposition, forOrAgainst) 
            values( ".$_POST['user_id'].", '".$_POST['prop_id']."', ".$_POST['forOrAgainst'].")";
        if ($conn->query($sql)) echo json_encode(array('success' => true));
        else echo json_encode(array('error' => 'error inserting account into databases'));
    } else echo json_encode(array('error' => 'missing data'));
