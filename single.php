<?php
/**
 * Template for Article single view
 */

 get_header();
?>

    <div class="outer">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();

                endwhile;
            endif;
        ?>
    </div>

<?php get_footer(); ?>
