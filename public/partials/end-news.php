<?php
/*
 * $bl_news contain the array of slide to be showed
 * %atts contains the attributes set on the shortcode
 * it also availeble the global variable $bl_news_printed to have information
 * about already printed gallery in the page
 * */

global $bl_news_printed;
?>

    </div>

    <?php if( count($bl_news) > 1 ): ?>
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-<?php echo count($bl_news_printed); ?>" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-<?php echo count($bl_news_printed); ?>" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <?php endif; ?>
</div>