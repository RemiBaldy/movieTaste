<?php


class Rating
{
    /**
     * @var username
     */
    /**
     * @var movie identifier
     */
    /**
     * @var grade value
     */
    private $uName,$movieId,$value;


    /**
     * Rating constructor.
     * @param $movieId
     */
    public function __construct($movieId)
    {
        $this->movieId = $movieId;
        $this->setUsernameSession();
    }

    /**
     * Static constructor / factory
     */
    public static function create($movieId) {
        $instance = new self($movieId);
        return $instance;
    }


    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }


    /**
     * Member var $uName is set to $_SESSION['login_user']
     */
    private function setUsernameSession(){
        if(!isset($_SESSION))
        {
            session_start();
        }
        $this->uName = $_SESSION['login_user'];
    }


    /**
     * Delete this from rating table database
     */
    public function deleteRatingFromDatabase()
    {
        include_once("SqlRequest.php");

        $request = "DELETE FROM ratingsSmall WHERE  movieId='$this->movieId' AND userId IN(SELECT userId FROM account WHERE username ='$this->uName');";

        $sqlRequest = new SqlRequest($request);
        $sqlRequest->connectAndRequest();
    }

    /**
     * Add this to rating table database
     */
    public function addRatingToDatabase(){
        include_once("SqlRequest.php");

        $request = "INSERT INTO ratingsSmall(userId,movieId,rating)
SELECT  account.userId, '$this->movieId','$this->value'
FROM    account
WHERE   username = '$this->uName'
ON DUPLICATE KEY UPDATE rating = '$this->value';";

        $sqlRequest = new SqlRequest($request);
        $sqlRequest->connectAndRequest();
    }


}