<?php
include_once("MoviesRequest.php");
include_once("MovieCardsGenerator.php");

$requestResult = MoviesRequest::getMyRatings();
MovieCardsGenerator::generateCardsDeleteButtonFromSqlRequestResult($requestResult);
exit();
?>
