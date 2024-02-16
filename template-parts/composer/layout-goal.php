<section class="goals<?php echo get_sub_field( 'pull_up' ) ? ' pull-up' : ''; ?>"<?php if ( $id = get_sub_field( 'background_image' ) ) : ?> style="background-image: url(<?php echo wp_get_attachment_url( $id ); ?>);"<?php endif; ?>>
    <div class="container">
        <div class="goals__row">
            <div class="goals__detail pull-right">
                <?php
                    cp_the_field( 'heading', '<span class="year">', '</span>', true );
                    cp_the_field( 'description', '<p class="copy">', '</p>', true );
                ?>
            </div>
        </div>
    </div>
</section>