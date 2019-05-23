<?php
include_once("MoviesRequest.php");
include_once("MovieCardsGenerator.php");

$requestResult = MoviesRequest::getRateMovies();
MovieCardsGenerator::generateCardsFromSqlRequestResultWithMaxIter($requestResult,150);
exit();
?>
