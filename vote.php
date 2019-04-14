<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");

    if(isset($_POST['user_id']) && isset($_POST['prop_id']) && isset($_POST['forOrAgainst']) ) {
        //Remove any existing vote of the user for that proposition
        $remSQL = "delete from re_vote where id_user = ".$_POST['user_id']." AND id_proposition = ".$_POST['prop_id'];
        $conn->exec($remSQL);

        //Insert new vote
        $sql = "insert into re_vote (id_user, id_proposition, forOrAgainst) 
            values( ".$_POST['user_id'].", '".$_POST['prop_id']."', ".$_POST['forOrAgainst'].")"
        ;
        
        if ($conn->query($sql)) {

            //Update Proposition Score

            //Count nb of positive votes for that prop
            $sql = "SELECT count(*) as positive FROM re_vote WHERE id_proposition = " . $_POST['prop_id'] . 
                " AND forOrAgainst = 1"
            ;
            if ($req = $conn->query($sql)) {
                $positive = ($req->fetch())['positive'];
            } else { echo json_decode(array('error' => 'Error while executing query')); }

            //Count nb of negative votes for that prop
            $sql = "SELECT count(*) as negative FROM re_vote WHERE id_proposition = " . $_POST['prop_id'] . 
                " AND forOrAgainst = -1"
            ;
            if ($req = $conn->query($sql)) {
                $negative = ($req->fetch())['negative'];
            } else { echo json_decode(array('error' => 'Error while executing query')); }

            //Update prop score
            $sql = "UPDATE re_proposition SET positive = " . $positive . 
                ", negative = " . $negative . " WHERE id = " . $_POST['prop_id'];

            if ($conn->query($sql)) { echo json_encode(array('success' => true)); }
            else { echo json_encode(array('error' => 'error inserting proposition into databases')); }
        } else echo json_encode(array('error' => 'error inserting vote into databases'));
    } else echo json_encode(array('error' => 'missing data'));
