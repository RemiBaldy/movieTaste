<?php
include_once("User.php");

if( $_POST["uname"] && $_POST["email"] && $_POST["psw"] && $_POST["cpsw"]) {

    $user = User::create($_POST["uname"], $_POST["psw"])->setEmail($_POST["email"]);

    //If passwords don't match
    if(!$user->isPasswordMatchingRegister($_POST['cpsw'])){
        //header("Location: ../html/signUp.html");
        $message = "Passwords not matching.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        exit();
    }

    $user->registerToDatabase();
    $user->createSessionVarUsername();
    header("Location: ../html/rateMovies.php");

}
exit();
?>
