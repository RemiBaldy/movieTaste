<?php

/**
 * Created by PhpStorm.
 * User: moi
 * Date: 20/05/2019
 * Time: 19:30
 */
class User
{
    /**
     * @var user's username
     */
    /**
     * @var user's email
     */
    /**
     * @var user's password
     */
    private $uname,$email,$password;


    /**
     * User constructor.
     * @param $uname
     * @param $password
     */
    public function __construct($uname, $password)
    {
        $this->uname = $uname;
        $this->password = $password;
    }

    /**
     * Static constructor / factory
     * @param $uname
     * @param $password
     * @return $instance, return self object User
     */
    public static function create($uname, $password) {
        $instance = new self($uname, $password);
        return $instance;
    }

    /**
     * @param $email
     * @return $this, return object User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


    /**
     * Check if user's password is matching with the confirmation password during SignUp
     * @param $somePassword
     * @return bool, true if password are matching, else false
     */
    function isPasswordMatchingRegister($somePassword){
        return $this->password == $somePassword;
    }

    /**
     * Check if user's password entered in LogIn is matching with the hashed password stored in Database
     * @param $hashedPassword
     * @return bool, true if password are matching, else false
     */
    function isPasswordMatchingLogIn($hashedPassword){
        return password_verify($this->password, $hashedPassword);
    }

    /**
     * Create user account by adding his informations to the account Database table
     * @param $hashedPassword
     */
    function createAccount($hashedPassword){
        include_once("SqlRequest.php");
        $request = "INSERT INTO account(username,password,email) VALUES ('$this->uname','$hashedPassword','$this->email')";

        $sqlRequest = new SqlRequest($request);
        if($sqlRequest->connectAndRequest())
            echo "account created successfully" . "<br />";
        else
            echo "username or email already used" . "<br />";
    }

    /**
     * Hash the user's password
     * @return bool|string
     */
    function hashPassword(){
        return password_hash($this->password, PASSWORD_DEFAULT);
    }


    /**
     * Hash the user's password and create user account
     */
    function registerToDatabase(){
        $this->createAccount($this->hashPassword());
    }

    /**
     * Retrieves password corresponding to user's username from database
     * @return array|null, password retrieved by the Sql request
     */
    function getPasswordFromDatabase(){
        include_once("SqlRequest.php");
        $request = "SELECT password FROM account WHERE username = '$this->uname'";

        $sqlRequest = new SqlRequest($request);
        $result = $sqlRequest->connectAndRequest();
        return mysqli_fetch_array($result);
    }

    /**
     * Verify that user's password and password retrived from database match.
     * If they match, user is connected : we create a $SESSION var with his username
     */
    function logIn(){
        if($this->isPasswordMatchingLogIn($this->getPasswordFromDatabase()[0])) {
            $this->createSessionVarUsername();
            header('Location: ../html/movies.php');
        }
        else
            echo "username or password invalid" . "<br />";
    }

    /**
     * Create a $SESSION var with user's username
     */
    function createSessionVarUsername(){
        if(!isset($_SESSION))
        {
            session_start();
        }
        $_SESSION['login_user']= $this->uname;
    }


}