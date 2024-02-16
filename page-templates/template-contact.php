<?php
/**
 * Template Name: Contact
 */
    get_header();
?>

<?php if ( get_field( 'enable_map' ) ) : ?>
<section class="contact-map">
<div class="map-holder" data-zoom="<?php the_field( 'map_zoom' ); ?>"></div>
</section>
<?php endif; ?>

<section class="contact-content">
    <div class="container">
        <div class="row">
            <div class="sidebar">
                <?php while ( have_rows( 'locations' ) ) : the_row(); ?>
                    <div class="col">
                        <?php cp_the_field( 'name', '<h4>', '</h4>', true ); ?>
                        <p>
                            <?php
                                if ( $tel = get_sub_field( 'telephone' ) ) :
                                    $clickable_number = get_sub_field( 'telephone_clickable' ) ? get_sub_field( 'telephone_clickable' ) : $tel;
                                    echo "Tel: <a href=\"tel:{$clickable_number}\">{$tel}</a>";
                                    echo "<br>";
                                endif;

                                if ( $cell = get_sub_field( 'cell' ) ) :
                                    $clickable_number = get_sub_field( 'cell_clickable' ) ? get_sub_field( 'cell_clickable' ) : $tel;
                                    echo "Cell: <a href=\"tel:{$clickable_number}\">{$cell}</a>";
                                    echo "<br>";
                                endif;

                                if ( $email = get_sub_field( 'email' ) ) :
                                    echo "<a href=\"mailto:{$email}\">{$email}</a>";
                                    echo "<br>";
                                endif;

                                cp_the_field( 'address', '', '', true );
                            ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="contact-form">
                <?php
                    cp_the_field( 'form_heading', '<h4>', '</h4>' );
                    cp_the_field( 'form_description', '<p>', '</p>' );
                    echo do_shortcode( get_field( 'form_shortcode' ) );
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();