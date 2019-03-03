<?php
    include('db.php');
    session_start();
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    $content = trim(file_get_contents(  "php://input"));
    if(isset($_POST['mail']) && isset($_POST['key']) ) {
        $sql = "select * from re_user where mail = '".$_POST['mail']."'";
        $req = $conn->query($sql);
        if($donnee = $req->fetch())
        {
            if($_POST['key'] == $donnee['keyActivation'])	{
                $conn->query("update re_user set isActivate = true where mail = '".$donnee['mail']."'");
                echo 'Votre compte a bien été activé ! ';
            } else echo json_encode(array('error' => 'wrong key'));
            $_SESSION['user'] = $donnee['mail'];
            $_SESSION['id'] = $donnee['id'];
        } else echo json_encode(array('error' => 'user not exist'));
    } else echo json_encode(array('error' => 'missing data'));


