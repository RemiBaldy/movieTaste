<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/moviesDisplay.css">
    <link rel="stylesheet" type="text/css" href="/css/rate.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="../js/rater.js" charset="utf-8"></script>
    <script src="../js/rateMovie.js"></script>

    <title>Recommendations</title>
</head>

<body>
<!--Navigation bar-->
<div id="nav-placeholder">
    <?php include "../php/navigationBarGenerator.php";?>
</div>
<!--end of Navigation bar-->

<div id ="grid-placeholder" class="grid-container">
    <?php include "../php/recommendedMoviesGenerator.php";?>
    <!--<script src="../php/moviesGenerator.php"></script>-->
</div>

<!-- <script type="text/javascript" src="../php/moviesGeneratorFromAPI.php"></script>-->
<!-- <script src="../php/myRecommendedMoviesGenerator.php"></script> -->



<!-- <script src="../js/rateBar.js" charset="utf-8"></script> -->

</body>
</html>