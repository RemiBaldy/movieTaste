<?php

$movieId = $_POST['id'];
include_once("Rating.php");
$rating = new Rating($_POST['id']);
$rating->deleteRatingFromDatabase();

exit();