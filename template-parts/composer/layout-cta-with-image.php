<?php
    $layout_id = 'layout-' . get_query_var( 'layout_count' );
?>
<style>
    <?php echo '#' . $layout_id; ?>:after {
        background-image: url(<?php echo wp_get_attachment_url( get_sub_field( 'image' ) ); ?>);
        background-position: <?php echo str_replace('_', ' ', get_sub_field( 'image_position' )); ?>
    }
</style>
<section id="<?php echo $layout_id; ?>" class="hero<?php echo get_sub_field( 'pull_section_up' ) ? ' pull-up' : ''; ?>">
    <div class="container">
        <div class="hero__row">
            <div class="hero__content">
                <?php
                    cp_the_field( 'heading', '<h1 class="hero__heading">', '</h1>', true );
                    cp_the_field( 'description', '<p class="hero__copy">', '</p>', true );
                    cp_the_link( get_sub_field( 'button' ), '', '', 'btn btn--black' );
                ?>
            </div>

            <?php if ( $id = get_sub_field( 'image' ) ) : ?>
            <div class="hero__img pull-right">
                <?php cp_get_attachment( $id, 'full', true ); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>