<?php

include_once("MovieCardBasic.php");
include_once("Rater.php");

class MovieCardMyRatings extends MovieCardBasic
{

    /**
     * @var float card's ratingValue
     */
    private $ratingValue;


    /**
     * MovieCardMyRatings constructor.
     * @param $movieId
     * @param $title
     * @param $release
     * @param $posterPath
     */
    public function __construct($movieId, $title, $release, $posterPath, $ratingValue)
    {
        parent::__construct($movieId, $title, $release, $posterPath);
        $this->ratingValue = $ratingValue;
    }


    /**
     * Create the html view corresponding to a MovieCardDeleteButton
     */
    function generateHtmlMovieCard()
    {?>
        <html>
        <div class="grid-card">
            <div class="title-grid">
                <div class="title">
                    <p><?php echo $this->title?> (<?php echo $this->release?>)</p>
                </div>
                <a id= "delete<?php echo $this->movieId?>"><img src="../images/delete.png"></a>
            </div>
            <div class="img">
                <img id="movie-img" src="https://image.tmdb.org/t/p/w154<?php echo $this->posterPath?>" alt="lotr">
            </div>
            <div class="rate">
                <div class="rate<?php echo $this->movieId?>">
                </div>
            </div>
        </div>
        </html>
        <script>setDeleteActions(<?php echo $this->movieId?>);</script>
            <?php $this->rater->setRatePropertiesWithValue($this->movieId, $this->ratingValue);
    }
}