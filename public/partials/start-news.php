<?php
/*
 * $bl_news contain the array of slide to be showed
 * %atts contains the attributes set on the shortcode
 * use this variables to customize your view
 * it also availeble the global variable $bl_news_printed to have information
 * about already printed gallery in the page
 * */

global $bl_news_printed;
?>

<div id="carousel-<?php echo count($bl_news_printed); ?>" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?foreach($bl_news as $bl_news_index => $bl_news_item): ?>
            <?php ( 0 === $bl_news_index ) ? $bl_news_class="active" : $bl_news_class=""; ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $bl_news_index?>" class="<?php echo $bl_news_class?>"></li>
        <?endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
