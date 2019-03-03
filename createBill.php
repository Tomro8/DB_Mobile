<?php
    include('db.php');
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['id'] = 6;
    $content = trim(file_get_contents(  "php://input"));
    if(isset($_POST['text']) ) {
        $sql = "insert into re_ticket (id_user, description) values( ".$_SESSION['id'].", '".$_POST['text']."')";
        if ($conn->query($sql)) echo json_encode(array('success' => true));
        else echo json_encode(array('error' => 'error inserting account into databases'));
    } else echo json_encode(array('error' => 'missing data'));


