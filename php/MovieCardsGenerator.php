<?php

/**
 * Class MovieCardsGenerator
 */
class MovieCardsGenerator
{

    /**
     * Iterates over the sql result containing the movies selected for a user and create the associated basic movie cards
     * @param $requestResult
     */
    static function generateCardsFromSqlRequestResult($requestResult){
        include_once("MovieCardBasic.php");
        while ($row = mysqli_fetch_row($requestResult)) {
            $movieCard = new MovieCardBasic($row[0],$row[1],substr($row[2],0,4),$row[3]);
            $movieCard->generateHtmlMovieCard();
        }
    }

    /**
     * Iterates over the sql result containing the movies selected for a user and create the associated with my ratings movie cards
     * @param $requestResult
     */
    static function generateCardsDeleteButtonFromSqlRequestResult($requestResult){
        include_once("MovieCardMyRatings.php");
        while ($row = mysqli_fetch_row($requestResult)) {
            $movieCard = new MovieCardMyRatings($row[0],$row[1],substr($row[2],0,4),$row[3],$row[4]);
            $movieCard->generateHtmlMovieCard();
        }
    }

    /**
     * Iterates over array containing the id of movies selected for a user and request informations to create the associated movie cards
     * @param $arrayRecommendedMoviesId
     */
    static function generateCardsFromArrayMoviesId($arrayRecommendedMoviesId){
        include_once("SqlRequest.php");
        for($i =1; $i < $arrayRecommendedMoviesId && $i < 100; $i++){

            $request = "SELECT * FROM moviesInfoSmall WHERE movieId = $arrayRecommendedMoviesId[$i];";
            $sqlRequest = new SqlRequest($request);
            $result = $sqlRequest->connectAndRequest();


            MovieCardsGenerator::generateCardsFromSqlRequestResult($result);


        }
    }


    public static function generateCardsFromSqlRequestResultWithMaxIter($requestResult, $maxIterations)
    {
        include_once("MovieCardBasic.php");
        $i =0;
        while ($row = mysqli_fetch_row($requestResult)) {
            $movieCard = new MovieCardBasic($row[0],$row[1],substr($row[2],0,4),$row[3]);
            $movieCard->generateHtmlMovieCard();
            $i++;
            if($i == $maxIterations){break;}
        }
    }

}