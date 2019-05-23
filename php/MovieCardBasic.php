<?php


include_once("MovieCard.php");
include_once("Rater.php");

/**
 * Class MovieCardBasic
 */
class MovieCardBasic implements MovieCard
{

    /**
     * @var int card's movieId
     */
    /**
     * @var string card's title
     */
    /**
     * @var string card's release date
     */
    /**
     * @var string card's poster path
     */
    /**
     * @var Rater
     */
    protected $movieId, $title, $release, $posterPath, $rater;

    /**
     * MovieCardBasic constructor.
     * @param $movieId
     * @param $title
     * @param $release
     * @param $posterPath
     */
    public function __construct($movieId, $title, $release, $posterPath)
    {
        $this->movieId = $movieId;
        $this->title = $title;
        $this->release = $release;
        $this->posterPath = $posterPath;
        $this->rater = new Rater();
    }


    /**
     * Create the html view corresponding to a MovieCardBasic
     */
    function generateHtmlMovieCard(){?>
        <html>
        <div class="grid-card">
            <div class="title">
                <p><?php echo $this->title?> (<?php echo $this->release?>)</p>
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
        <?php $this->rater->setRateProperties($this->movieId);
    }


}
?>