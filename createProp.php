<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    if( isset($_POST['title']) && isset($_POST['text']) && isset($_POST['user_id']) ) {
        $sql = "insert into re_proposition (id, id_user, title, description, positive, negative) 
            values( NULL, '".$_POST['user_id']."', '".$_POST['title']."', '".$_POST['text']."', 0, 0)";
        if ($conn->query($sql)) 
            { echo json_encode(array('success' => true)); }
        else 
            { echo json_encode(array('error' => 'error inserting proposition into databases')); }
    } else { echo json_encode(array('error' => 'missing data')); }


