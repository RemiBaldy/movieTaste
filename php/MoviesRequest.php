<?php

/**
 * Created by PhpStorm.
 * User: moi
 * Date: 17/05/2019
 * Time: 09:22
 */
class MoviesRequest
{
    /**
     *Echo the movies informations rated by the current user in order to use them later for display in javascript.
     *
     */
    public static function getMyRatings()
    {
        include_once("SqlRequest.php");

        if(!isset($_SESSION))
        {
            session_start();
        }
        $userName = $_SESSION['login_user'];

        $request = "SELECT m.movieId,title,release_date,poster_path,rating FROM moviesInfoSmall m,ratingsSmall r WHERE m.movieId = r.movieId AND r.userId IN(SELECT userId FROM account WHERE username ='$userName');";

        $sqlRequest = new SqlRequest($request);
        $result = $sqlRequest->connectAndRequest();

        return $result;
    }

    /**
     *Echo the movies informations recommended for the current user in order to use them later for display in javascript.
     */
    public static function getMyRecommendedMovies()
    {
        include_once ("ClientTCP.php");
        include_once("MovieCardsGenerator.php");

        if(!isset($_SESSION))
        {
            session_start();
        }
        $userName = $_SESSION['login_user'];

        $client = new ClientTCP("localhost",1234,20);
        $client->connectToServer();
        $client->sendRequestMovies(MoviesRequest::getUserIdByUserName($userName));
        $arrayRecommendedMoviesId = $client->getServerResponseArrayFormat();

        //check if response from server is Empty, because the user didn't rate any movies
        if(!isset($arrayRecommendedMoviesId[1])){
            echo "You need to rate movies to access those powerfull recommandations";
            return;
        }


        MovieCardsGenerator::generateCardsFromArrayMoviesId($arrayRecommendedMoviesId);

        exit();
    }

    static function getUserIdByUserName($userName){
        include_once("SqlRequest.php");
        $request = "SELECT userId FROM account WHERE username = '$userName'";

        $sqlRequest = new SqlRequest($request);
        $result = $sqlRequest->connectAndRequest();
        return mysqli_fetch_array($result)[0];
    }


    public static function getRateMovies()
    {
        include_once("SqlRequest.php");

        if(!isset($_SESSION))
        {
            session_start();
        }
        $userName = $_SESSION['login_user'];

        $request = "SELECT * FROM moviesInfoSmall m WHERE m.movieId NOT IN (SELECT movieId FROM ratingsSmall WHERE userId = (SELECT userId FROM account WHERE username = '$userName'))ORDER BY ratings_count DESC;";


        $sqlRequest = new SqlRequest($request);
        $result = $sqlRequest->connectAndRequest();

        return $result;
    }
}
?>