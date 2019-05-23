
<?php if(!isset($_SESSION))
{
    session_start();
}?>

<link rel="stylesheet" type="text/css" href="/css/navigationBar.css">

<div class="topnav">
    <a href="movies.php">Recommended</a>
    <a href="myRatings.php">My ratings</a>
    <a href="rateMovies.php">Rate movies</a>
    <a id="dropdown" href="#"><img src="../images/profile.png">
        <?php  echo $_SESSION['login_user']?></a>
</div>
