<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    if( isset($_POST['title']) && isset($_POST['text']) && isset($_POST['user_id']) ) {
        $sql = "insert into re_proposition (id_user, titre, description) 
            values('".$_POST['user_id']."', '".$_POST['title']."', '".$_POST['text']."')";
        if ($conn->query($sql)) 
            { echo json_encode(array('success' => true)); }
        else 
            { echo json_encode(array('error' => 'error inserting proposition into databases')); }
    } else { echo json_encode(array('error' => 'missing data')); }


