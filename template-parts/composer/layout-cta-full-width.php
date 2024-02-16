<section class="vision">
    <div class="container">
        <?php
            cp_the_field( 'heading', '<h4 class="vision__heading">', '</h4>', true );
            cp_the_field( 'description', '<p class="vision__copy">', '</p>', true );
            cp_the_link( get_sub_field( 'button'), '', '', 'btn btn--black' );
        ?>
    </div>
</section>