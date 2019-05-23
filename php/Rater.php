<?php

class Rater
{
    /**
     * Add javascript function for rating bar configuration into html <script>
     * @param $movieId
     * @param $ratingValue
     */
    function setRatePropertiesWithValue($movieId, $ratingValue){?>
        <script>setRatePropertiesWithValue(<?php echo $movieId?>,<?php echo $ratingValue?>);</script>
 <?php   }

    /**
     * Add javascript function for rating bar configuration into html <script>
     * @param $movieId
     */
    function setRateProperties($movieId){?>
        <script>setRateProperties(<?php echo $movieId?>)</script>
    <?php   }

}
?>