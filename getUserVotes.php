<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $votes = array();

    if(isset($_POST['user_id']) ) {
        $sql = "SELECT * FROM re_vote WHERE id_user = '".$_POST['user_id']."'";
        if ($req = $conn->query($sql)) {
            while($vote = $req->fetch()) {
                array_push($votes, $vote);
            }
            echo json_encode(array('votes' => $votes));
        } else { echo json_encode(array('error' => 'Error while executing Select request')); }
    } else { echo json_encode(array('error' => 'Missing data')); }
