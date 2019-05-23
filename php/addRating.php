<?php

include_once("Rating.php");

$rating = Rating::create( $_POST['movieId'])->setValue($_POST['value']);
$rating->addRatingToDatabase();

exit();