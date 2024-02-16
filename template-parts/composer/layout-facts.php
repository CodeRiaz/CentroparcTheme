<?php
    $layout_id = 'layout-' . get_query_var( 'layout_count' );
?>
<style>
    <?php echo '#' . $layout_id; ?>:before {
        background-image: url(<?php echo wp_get_attachment_url( get_sub_field( 'image' ) ); ?>);
        background-position: <?php echo str_replace('_', ' ', get_sub_field( 'image_position' )); ?>
    }
</style>
<h4 class="section-title--mobile"><?php the_sub_field( 'heading' ); ?></h4>
<section id="<?php echo $layout_id; ?>" class="investment">
    <div class="container">
        <div class="investment__row">
            <div class="investment__thumbnail pull-right">
                <?php cp_get_attachment( get_sub_field( 'image' ), 'full', true ); ?>
            </div>

            <div class="investment__description">
                <h3 class="main-heading hidden-mobile"><?php the_sub_field( 'heading' ); ?></h3>

                <?php if ( have_rows( 'facts' ) ) : ?>
                <ul class="investment__detail">
                    <?php while ( have_rows( 'facts' ) ) : the_row(); ?>
                        <li>
                            <span class="orange"><?php the_sub_field( 'fact' ); ?></span>
                            <span class="black"><?php the_sub_field( 'label' ); ?></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <div class="investment__amenities hidden-mobile">
                    <?php
                        cp_the_field( 'features_heading', '<span class="title">', '</span>', true );

                        if ( have_rows( 'features' ) ) :
                            echo '<ul>';
                            while ( have_rows( 'features' ) ) :
                                the_row();
                                cp_the_field( 'feature', '<li>', '</li>', true );
                            endwhile;
                            echo '</ul>';
                        endif
                    ?>
                </div>

                <?php cp_the_link( get_sub_field( 'button' ), '', '', 'btn btn--black hidden-mobile' ); ?>
            </div>
        </div>
    </div>
</section>