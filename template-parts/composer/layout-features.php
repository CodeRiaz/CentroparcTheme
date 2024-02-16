<?php
    $layout_id = 'layout-' . get_query_var( 'layout_count' );
?>
<style>
    <?php echo '#' . $layout_id; ?>:before {
        background-image: url(<?php echo wp_get_attachment_url( get_sub_field( 'image' ) ); ?>);
        background-position: <?php echo str_replace('_', ' ', get_sub_field( 'image_position' )); ?>
    }
</style>
<section id="<?php echo $layout_id; ?>" class="feature">
    <div class="container">
        <div class="feature__row">
            <div class="feature__img">
                <?php
                    cp_get_attachment( get_sub_field( 'image' ), 'full', true );
                    get_template_part( 'template-parts/icon', 'expand' );
                ?>
            </div>

            <div class="feature__content">
                <?php cp_the_field( 'heading', '<h2 class="feature__title">', '</h2>', true ); ?>

                <?php while ( have_rows( 'features' ) ) : the_row(); ?>
                    <div class="feature__inner">
                        <?php
                            cp_the_field( 'heading', '<h3 class="feature__heading">', '</h3>', true );
                            cp_the_field( 'description', '<p class="feature__copy">', '</p>', true );
                        ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>