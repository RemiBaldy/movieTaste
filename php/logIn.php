<?php
include_once("User.php");

if( $_POST["uname"] &&  $_POST["psw"]){

    $user = new User($_POST['uname'],$_POST['psw']);
    $user->logIn();
}
exit();
?>