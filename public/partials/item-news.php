<?php
/*
 * $bl_news contain the post object for the printing slide
 * $bl_news_item_index the index fot the slide
 * %atts contains the attributes set on the shortcode
 * use this variables to customize your view
 * it also availeble the global variable $bl_news_printed to have information
 * about already printed gallery in the page
 * */

global $bl_news_printed;

( 0 === $bl_news_index ) ? $bl_news_class="active" : $bl_news_class="";
?>

<div class="item <?php echo $bl_news_class?>">
    <?php if ( has_post_thumbnail( $bl_news_item->ID ) ) { // check if the post has a Post Thumbnail assigned to it.
        echo    get_the_post_thumbnail( $bl_news_item->ID );
    }?>
    <div class="carousel-caption">
        <h2><?php echo $bl_news_item->post_title; ?></h2>
        <?php echo $bl_news_item->post_content; ?>
    </div>
</div>
